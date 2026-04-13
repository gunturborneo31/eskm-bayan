<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminSession
{
    /**
     * Ensure admin pages are only accessible after successful login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('user_id')) {
            return redirect('/login')->withErrors([
                'username' => 'Silakan login terlebih dahulu.',
            ]);
        }

        return $next($request);
    }
}
