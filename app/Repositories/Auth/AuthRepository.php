<?php

namespace App\Repositories\Auth;

interface AuthRepository
{
    public function login();
    public function logout();
    public function register();
    public function resetPassword();
    public function changePassword();
    public function getUserProfile();
    public function updateUserProfile();
    public function deleteUserAccount();
}
