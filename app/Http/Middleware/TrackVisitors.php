<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldTrack($request)) {
            $sessionId = $request->session()->getId();

            if (! empty($sessionId)) {
                $now = now();
                $visitor = Visitor::firstOrNew(['session_id' => $sessionId]);

                if (! $visitor->exists) {
                    $visitor->first_visited_at = $now;
                }

                $visitor->ip_address = $request->ip();
                $visitor->user_agent = $request->userAgent();
                $visitor->last_visited_at = $now;
                $visitor->save();
            }
        }

        return $next($request);
    }

    protected function shouldTrack(Request $request): bool
    {
        return $request->isMethod('get')
            && ! $request->expectsJson()
            && ! $request->is('admin', 'admin/*');
    }
}
