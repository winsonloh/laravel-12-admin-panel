<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CheckInternalUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !($user instanceof User)) {
            $user = User::find($user->id);
        }

        if ($user && !$user->isActive()) {
            Auth::logout();
            throw ValidationException::withMessages([
                'username' => trans('auth.account_disabled'),
            ]);
        }

        return $next($request);
    }
}
