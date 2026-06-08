<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $secrets = Secret::where('user_id', Auth::id())
            ->latest()
            ->get()
            ->map(function ($secret) {
                $status = 'active';
                if ($secret->expires_at && $secret->expires_at->isPast()) {
                    $status = 'expired';
                } elseif ($secret->view_count >= $secret->max_views) {
                    $status = 'destroyed';
                }

                return [
                    'token' => $secret->token,
                    'audit_token' => $secret->audit_token,
                    'max_views' => $secret->max_views,
                    'view_count' => $secret->view_count,
                    'has_password' => !is_null($secret->password_hash),
                    'notify_email' => $secret->notify_email,
                    'status' => $status,
                    'expires_at' => $secret->expires_at?->format('d M Y, h:i A'),
                    'viewed_at' => $secret->viewed_at?->format('d M Y, h:i A'),
                    'created_at' => $secret->created_at->format('d M Y, h:i A'),
                ];
            });

        $stats = [
            'total' => $secrets->count(),
            'active' => $secrets->where('status', 'active')->count(),
            'destroyed' => $secrets->where('status', 'destroyed')->count(),
            'expired' => $secrets->where('status', 'expired')->count(),
        ];

        return Inertia::render('Dashboard', [
            'secrets' => $secrets,
            'stats' => $stats,
        ]);
    }

    public function destroy(Request $request, string $token)
    {
        Secret::where('token', $token)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Secret deleted.');
    }
}