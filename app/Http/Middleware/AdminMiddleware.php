<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // [cite: 406]
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan role-nya adalah 'admin' [cite: 417]
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Lanjutkan ke halaman jika Admin [cite: 419]
        }

        // Jika bukan admin, tolak akses (Error 403) [cite: 420]
        abort(403, 'Unauthorized');
    }
}