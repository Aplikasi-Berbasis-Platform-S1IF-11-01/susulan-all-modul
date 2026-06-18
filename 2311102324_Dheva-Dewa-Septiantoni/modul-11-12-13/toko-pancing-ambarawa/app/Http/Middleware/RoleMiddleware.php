<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Jika user belum login atau role user tidak sesuai dengan yang diminta, tolak akses
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Akses dermaga tidak diizinkan untuk role Anda!');
        }

        return $next($request);
    }
}