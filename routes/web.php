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
})->name('welcome');

Route::prefix('auth')->group(function () {

    ## Login Routes
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('{guard}/login', [AuthController::class, 'login'])->name('auth.login.post');

    ## Register Routes
    Route::get('{guard}/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('{guard}/register', [AuthController::class, 'register'])->name('auth.register.post');

    ## Reset Password Routes
    Route::get('{guard}/reset-password', [AuthController::class, 'showResetPassword'])->name('auth.reset-password');
    Route::post('{guard}/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password.post');
});

## Logout Route
// This route is outside the auth prefix to allow access without guard
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('dashboard/admin')->middleware('auth:admin')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
    // في موضوع المسارات انا وقعت في خطأ شائع وهو الترتيب
    // في ترتيب المسارات بحيث اني وضعت مسار البحث قبل مسار الموارد
    // وهذا جعل مسار البحث لا يعمل بشكل صحيح ولا حتى مسار جلب المحذوفات
    Route::get('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('products/trashed', [ProductController::class, 'getTrashedProducts'])->name('products.trashed');
    Route::get('products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::resource('products', ProductController::class);
    //////////////////////////////////////////////////////
    Route::resource('categories', CategoryController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('accounts', AccountsController::class);

    ## Change Password Routes
    Route::get('{guard}/change-password', [DashboardController::class, 'showChangePassword'])->name('change-password');
    Route::post('{guard}/change-password', [DashboardController::class, 'changePassword'])->name('change-password.post');

});

## if i need to test session data and check if session is working
Route::get('/test-session', function () {
    return dd(session()->all());
});

Route::prefix('dashboard/manager')->middleware('auth:manager')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('manager.dashboard');
});
Route::prefix('dashboard/customer')->middleware('auth:customer')->group(function () {
    Route::get('/home/{slug}', [CustomerController::class, 'index'])->name('home');
});
