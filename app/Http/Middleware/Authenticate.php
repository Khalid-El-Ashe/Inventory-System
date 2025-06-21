<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Try to get guard from route (if you use {guard} in your routes)
        $guard = $request->route('guard');

        // Or fallback to default guard if not found
        if (!$guard) {
            $guard = Auth::getDefaultDriver();
        }

        // return route('auth.login', $guard);
        return $request->expectsJson() ? null : route('auth.login', $guard);
    }
}
