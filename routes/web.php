<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Dashboard\AccountsController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SaleController;
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
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('accounts', AccountsController::class);
});
Route::prefix('dashboard/manager')->middleware('auth:manager')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('manager.dashboard');
});
Route::prefix('dashboard/customer')->middleware('auth:customer')->group(function () {
    Route::get('/home/{slug}', [CustomerController::class, 'index'])->name('home');
});
