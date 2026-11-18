<?php

namespace App\Http\Middleware;

use App\Models\WebsiteVisitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya catat request GET normal untuk halaman publik (bukan ajax, bukan asset, bukan api/up)
        if ($request->isMethod('GET') && !$request->ajax()) {
            $path = $request->path();

            // Hindari tracking internal health check atau file statis jika ada
            if ($path !== 'up' && !str_starts_with($path, 'api/')) {
                try {
                    $ip = $request->ip();
                    $ua = substr($request->userAgent() ?: 'Unknown Browser', 0, 255);
                    $pageUrl = $path === '/' ? '/' : '/' . ltrim($path, '/');
                    $sessionId = $request->session()->getId();

                    // Cek apakah pengunjung dengan session / IP yang sama pada halaman yang sama sudah tercatat dalam 15 menit terakhir
                    // Hal ini mencegah refresh berulang kali membengkakkan data secara tidak wajar
                    $alreadyLogged = WebsiteVisitor::where('page_url', $pageUrl)
                        ->where(function ($query) use ($sessionId, $ip) {
                            if (!empty($sessionId)) {
                                $query->where('session_id', $sessionId);
                            } else {
                                $query->where('ip_address', $ip);
                            }
                        })
                        ->where('created_at', '>=', now()->subMinutes(15))
                        ->exists();

                    if (!$alreadyLogged) {
                        WebsiteVisitor::create([
                            'ip_address' => $ip,
                            'user_agent' => $ua,
                            'page_url' => $pageUrl,
                            'session_id' => $sessionId,
                        ]);
                    }
                } catch (\Throwable $e) {
                    // Jangan pernah mengganggu respons halaman jika terjadi error tracking
                }
            }
        }

        return $response;
    }
}
