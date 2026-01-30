<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthSiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if siswa session exists
        if (session('user_type') === 'siswa' && session('nis')) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Silakan login terlebih dahulu sebagai siswa.');
    }
}
