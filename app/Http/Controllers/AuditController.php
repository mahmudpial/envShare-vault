<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use App\Models\SecretLog;
use Inertia\Inertia;

class AuditController extends Controller
{
    public function show(string $auditToken)
    {
        $secret = Secret::where('audit_token', $auditToken)->first();

        $logs = SecretLog::where('token', $auditToken)
            ->latest()
            ->get()
            ->map(fn($log) => [
                'id' => $log->id,
                'ip_address' => $log->ip_address,
                'device' => $log->device,
                'browser' => $log->browser,
                'os' => $log->os,
                'event' => $log->event,
                'time' => $log->created_at->format('d M Y, h:i A'),
            ]);

        return Inertia::render('Audit', [
            'logs' => $logs,
            'exists' => !is_null($secret),
        ]);
    }
}