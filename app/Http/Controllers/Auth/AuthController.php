<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Manager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin(Request $request, $guard)
    {
        return response()->view('auth.login', ['guard' => $guard]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'remember' => 'nullable|boolean',
            'guard' => 'required|string|in:admin,manager,customer'
        ], [
            'guard.in' => 'Please check the login link (guard).'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $credentials = $request->only('email', 'password');
        $guard = $request->get('guard');
        $remember = $request->get('remember', false);

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


    public function showRegister(Request $request, $guard)
    {
        if (!in_array($guard, ['admin', 'manager', 'customer'])) {
            abort(404);
        }

        return view('auth.register', ['guard' => $guard]);
    }
    public function register(Request $request, $guard)
    {
        if (!in_array($guard, ['admin', 'manager', 'customer'])) {
            return response()->json([
                'message' => 'Invalid user type.'
            ], Response::HTTP_BAD_REQUEST);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:100',
            'email' => 'required|string|email|unique:' . $this->getTableName($guard),
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 5 characters long.',
            'name.max' => 'Name must not exceed 100 characters.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email address already in use.',
            'password.min' => 'Password must be at least 6 characters long.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $model = $this->getModelClass($guard);

        $model::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => "Your $guard account has been created successfully, you can log in now.",
            'redirect' => route('auth.login', $guard)
        ], Response::HTTP_CREATED);
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

    public function logout(Request $request): RedirectResponse
    {
        $guard = Auth::guard('admin')->check()
            ? 'admin'
            : (Auth::guard('manager')->check() ? 'manager' : 'customer');

        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login', $guard);

        // Auth::guard($guard)->logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // $request->session()->flush();

        // return redirect('/');
    }


    // public function logout(Request $request)
    // {
    // $guard = Auth::guard('admin')->check()
    //     ? 'admin'
    //     : (Auth::guard('manager')->check() ? 'manager' : 'customer');

    //     Auth::guard($guard)->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return response()->json([
    //         'message' => 'logined is successfully',
    //         'redirect' => route('auth.login', $guard),
    //     ]);
    // }
}
