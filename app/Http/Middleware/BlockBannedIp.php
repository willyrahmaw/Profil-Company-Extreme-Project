<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\LoginIpBan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockBannedIp
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bans come from failed admin logins, so only lock the IP out of the admin area.
        // Keeping the public site open avoids punishing other visitors behind a shared IP (CGNAT).
        if ($request->routeIs('banned') || ! $request->is('admin', 'admin/*')) {
            return $next($request);
        }

        if (LoginIpBan::status($request) !== null) {
            return redirect()->route('banned');
        }

        return $next($request);
    }
}