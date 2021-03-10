<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!\Sentinel::check()) {
            return redirect()->route('admin.login')->with('flashMessage', [
                'class'  =>  'warning',
                'message'   =>  'Please login first.'
            ]);
        }
        $user = \Sentinel::getUser();
        $permissions = $user->permissions;
        if (!isset($permissions['admin'])) {
            return redirect()->route('admin.login')->with('flashMessage', [
                'class'  =>  'warning',
                'message'   =>  'Please login first.'
            ]);
        }
        if ($permissions['admin'] != 1) {
            return redirect()->route('admin.login')->with('flashMessage', [
                'class'  =>  'warning',
                'message'   =>  'Please login first.'
            ]);
        }
        return $next($request);
    }
}
