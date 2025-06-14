<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('{guard}/login', [AuthController::class, 'login'])->name('auth.login.post');

    Route::get('{guard}/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('{guard}/register', [AuthController::class, 'register'])->name('auth.register.post');
});

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('dashboard/admin')->middleware('auth:admin')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
});
Route::prefix('dashboard/manager')->middleware('auth:admin,manager')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('manager.dashboard');
});
Route::prefix('dashboard/customer')->middleware('auth:admin,customer')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('customer.dashboard');
});
