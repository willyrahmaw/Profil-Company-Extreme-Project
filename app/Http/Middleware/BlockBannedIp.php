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
        if ($request->routeIs('banned')) {
            return $next($request);
        }

        if (LoginIpBan::status($request) !== null) {
            return redirect()->route('banned');
        }

        return $next($request);
    }
}