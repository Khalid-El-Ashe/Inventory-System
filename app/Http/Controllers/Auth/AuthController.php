<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthFormRequest;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showLogin($guard)
    {
        return response()->view('auth.login', ['guard' => $guard]);
    }
    public function login(AuthFormRequest $request)
    {
        return $this->repository->login($request);
    }


    public function showRegister($guard)
    {
        if (!in_array($guard, ['admin', 'manager', 'customer'])) {
            abort(404);
        }

        return view('auth.register', ['guard' => $guard]);
    }
    public function register(AuthFormRequest $request, $guard)
    {
        return $this->repository->register($request, $guard);
    }


    public function logout(Request $request): RedirectResponse
    {
        return $this->repository->logout($request);
    }

    public function showResetPassword($guard)
    {
        if (!in_array($guard, ['admin', 'manager', 'customer'])) {
            abort(404);
        }
        return response()->view('auth.reset-password', ['guard' => $guard]);
    }
    public function resetPassword(AuthFormRequest $request, $guard) {
        return $this->repository->resetPassword($request,$guard);
    }
}
