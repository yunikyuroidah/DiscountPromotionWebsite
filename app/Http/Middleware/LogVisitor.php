<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $path = '/' . ltrim($request->path(), '/');
        $ipAddress = $request->ip() ?? '0.0.0.0';
        $visitedAt = Carbon::now();

        $alreadyLogged = VisitorLog::query()
            ->whereDate('visited_at', $visitedAt->toDateString())
            ->where('ip_address', $ipAddress)
            ->where('path', $path)
            ->exists();

        if (!$alreadyLogged) {
            VisitorLog::create([
                'path' => $path,
                'ip_address' => $ipAddress,
                'user_agent' => $request->userAgent(),
                'referrer' => $request->headers->get('referer'),
                'visited_at' => $visitedAt,
            ]);
        }

        return $response;
    }
}
