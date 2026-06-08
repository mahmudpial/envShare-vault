<?php

namespace App\Http\Controllers;

use App\Mail\SecretViewed;
use App\Models\Secret;
use App\Services\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SecretController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }

    public function store(Request $request)
    {
        // 1. Update validation to accept your new keys
        $validated = $request->validate([
            'content' => 'required|string',
            'max_views' => 'integer|min:1|max:10',
            'expires_in' => 'required|in:5m,15m,30m,1h,2h,5h,12h,24h',
            'password' => 'nullable|string|min:4',
            'notify_email' => 'nullable|email',
        ]);

        // 2. Map the UI strings to actual minutes
        $minutes = match ($validated['expires_in']) {
            '5m' => 5,
            '15m' => 15,
            '30m' => 30,
            '1h' => 60,
            '2h' => 120,
            '5h' => 300,
            '12h' => 720,
            '24h' => 1440,
            default => 1440,
        };

        $auditToken = Str::random(32);

        $secret = Secret::create([
            'user_id' => Auth::id(),
            'token' => Str::random(32),
            'audit_token' => $auditToken,
            'payload' => Crypt::encryptString($validated['content']),
            'password_hash' => !empty($validated['password'])
                ? bcrypt($validated['password'])
                : null,
            'max_views' => $validated['max_views'] ?? 1,
            // 3. Use addMinutes based on the mapped value
            'expires_at' => now()->addMinutes($minutes),
            'notify_email' => $validated['notify_email'] ?? null,
        ]);

        return redirect()->route('dashboard')->with([
            'token' => $secret->token,
            'audit_token' => $auditToken,
            'success' => 'Secret link generated successfully!'
        ]);
    }

    public function show(string $token)
    {
        $secret = Secret::where('token', $token)->firstOrFail();

        if ($secret->expires_at && $secret->expires_at->isPast()) {
            $secret->delete();
            return Inertia::render('Expired');
        }

        if ($secret->view_count >= $secret->max_views) {
            $secret->delete();
            return Inertia::render('Expired');
        }

        return Inertia::render('Reveal', [
            'token' => $token,
            'needsPassword' => !is_null($secret->password_hash),
        ]);
    }

    public function reveal(Request $request, string $token)
    {
        $secret = Secret::where('token', $token)->firstOrFail();

        // Expired / max views check
        if ($secret->expires_at && $secret->expires_at->isPast()) {
            $secret->delete();
            return Inertia::render('Expired');
        }

        if ($secret->view_count >= $secret->max_views) {
            $secret->delete();
            return Inertia::render('Expired');
        }

        // ── Rate Limiting ──────────────────────────────────────────
        // Key: ip + token — so each secret gets its own limit per IP
        $rateLimitKey = 'reveal:' . $request->ip() . ':' . $token;

        if (RateLimiter::tooManyAttempts($rateLimitKey, maxAttempts: 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return back()->withErrors([
                'password' => "Too many failed attempts. Try again in {$seconds} seconds.",
            ]);
        }
        // ──────────────────────────────────────────────────────────

        // Password check
        if ($secret->password_hash) {
            if (!$request->password || !Hash::check($request->password, $secret->password_hash)) {
                // Hit the rate limiter on wrong password
                RateLimiter::hit($rateLimitKey, 900); // 15 minutes

                $remaining = 5 - RateLimiter::attempts($rateLimitKey);

                LogHelper::record($request, $secret->audit_token, 'failed_password');

                return back()->withErrors([
                    'password' => $remaining > 0
                        ? "Wrong password. {$remaining} attempt(s) remaining."
                        : 'Too many failed attempts. Try again in 15 minutes.',
                ]);
            }
        }

        // Clear rate limiter on success
        RateLimiter::clear($rateLimitKey);

        // Decrypt
        $content = Crypt::decryptString($secret->payload);
        $notifyEmail = $secret->notify_email;
        $secretToken = $secret->token;
        $auditToken = $secret->audit_token;

        // Log successful view
        LogHelper::record($request, $auditToken, 'viewed');

        $secret->increment('view_count');
        $secret->update(['viewed_at' => now()]);

        if ($secret->view_count >= $secret->max_views) {
            $secret->delete();
        }

        // Email notification
        if ($notifyEmail) {
            try {
                Mail::to($notifyEmail)->send(new SecretViewed(
                    ip: $request->ip() ?? 'Unknown',
                    viewedAt: now()->format('d M Y, h:i A'),
                    token: $secretToken,
                ));
            } catch (\Exception $e) {
                logger()->error('SecretViewed mail failed: ' . $e->getMessage());
            }
        }

        return Inertia::render('Reveal', [
            'token' => $token,
            'content' => $content,
        ]);
    }
}