<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminOrMerchSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('user_id') && ! $request->session()->has('merch_user')) {
            return redirect('/login')->withErrors([
                'username' => 'Silakan login terlebih dahulu.',
            ]);
        }

        return $next($request);
    }
}
