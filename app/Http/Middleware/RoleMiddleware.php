<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // role yang diizinkan (misalnya: admin, warga)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Cek apakah role user sesuai dengan role yang diizinkan
        if (auth()->user()->role !== $role) {
            abort(403, 'Akses ditolak — Anda tidak memiliki izin untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
