<?php

namespace App\Repositories\Auth;

use App\Http\Requests\AuthFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


interface AuthRepository // you must add this class in the AppServiceProvider
{
    public function login(AuthFormRequest $request);
    public function logout(Request $request): RedirectResponse;
    public function register(AuthFormRequest $request, $guard);
    public function resetPassword(AuthFormRequest $request,$guard);
    public function getUserProfile();
    public function updateUserProfile();
    public function deleteUserAccount();
}
