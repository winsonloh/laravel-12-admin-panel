<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle($request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        // (Optional) If you want to ensure the user has an "admin" role, add:
        // if (! Auth::user()->hasRole('admin')) {
        //     return abort(403);
        // }

        return $next($request);
    }
}
