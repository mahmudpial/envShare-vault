<?php

namespace App\Services;

use App\Models\SecretLog;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class LogHelper
{
    public static function record(Request $request, string $token, string $event = 'viewed'): void
    {
        $agent = new Agent();
        $agent->setUserAgent($request->userAgent());

        SecretLog::create([
            'token' => $token,
            'ip_address' => $request->ip(),
            'device' => $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop'),
            'browser' => $agent->browser() ?: 'Unknown',
            'os' => $agent->platform() ?: 'Unknown',
            'event' => $event,
        ]);
    }
}