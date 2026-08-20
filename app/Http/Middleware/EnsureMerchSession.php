<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMerchSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('merch_user')) {
            return redirect('/merch/login');
        }

        return $next($request);
    }
}
