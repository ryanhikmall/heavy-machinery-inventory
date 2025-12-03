<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN role-nya admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Silakan lewat
        }

        // Jika bukan admin, tendang ke dashboard atau tampilkan error 403
        abort(403, 'ANDA TIDAK MEMILIKI AKSES ADMIN.');
    }
}