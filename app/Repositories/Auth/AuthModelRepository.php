<?php

namespace App\Repositories\Auth;

use App\Http\Requests\AuthFormRequest;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Manager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthModelRepository implements AuthRepository // you must add this class in the RepositoryServiceProvider
{
    public function login(AuthFormRequest $request)
    {
        // Implement login logic
        $validated = $request->validated();

        $credentials = $request->only('email', 'password');
        $guard = $validated['guard'];
        $remember = $validated['remember'] ?? false;

        if (Auth::guard($guard)->attempt($credentials, $remember)) {
            return response()->json([
                'message' => 'login is successfully',
                'redirect' => route($guard . '.dashboard')
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'some data login is wrong, please try again.'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        // Implement logout logic
        // $guard = Auth::guard('admin')->check()
        //     ? 'admin'
        //     : (Auth::guard('manager')->check() ? 'manager' : 'customer');
        $guards = ['admin', 'manager', 'customer'];
        $guard = collect($guards)->first(fn($g) => Auth::guard($g)->check());

        if (!$guard) {
            abort(403, 'No logged in user found.');
        }

        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login', $guard);
    }

    public function register(AuthFormRequest $request, $guard)
    {
        // Implement registration logic
        if (!in_array($guard, ['admin', 'manager', 'customer'])) {
            return response()->json([
                'message' => 'Invalid user type.'
            ], Response::HTTP_BAD_REQUEST);
        }


        $validated = $request->validated();
        $model = $this->getModelClass($guard);

        $model::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => "Your $guard account has been created successfully, you can log in now.",
            'redirect' => route('auth.login', $guard)
        ], Response::HTTP_CREATED);
    }

    public function resetPassword()
    {
        // Implement password reset logic
    }

    public function changePassword()
    {
        // Implement password change logic
    }

    public function getUserProfile()
    {
        // Implement user profile retrieval logic
    }

    public function updateUserProfile()
    {
        // Implement user profile update logic
    }

    public function deleteUserAccount()
    {
        // Implement user account deletion logic
    }

    private function getModelClass($guard)
    {
        return match ($guard) {
            'admin' => Admin::class,
            'manager' => Manager::class,
            'customer' => Customer::class,
            default => abort(404, 'Invalid user type'),
        };
    }

    private function getTableName($guard)
    {
        return match ($guard) {
            'admin' => 'admins',
            'manager' => 'managers',
            'customer' => 'customers',
            default => abort(404, 'Invalid table'),
        };
    }
}
