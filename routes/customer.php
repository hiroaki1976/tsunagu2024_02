<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\LoginController;

// Customer 認証不要
// Route::group(['prefix' => 'customer'], function() {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
// });

// Customer ログイン画面
Route::get('/customer/login', [LoginController::class, 'create'])->name('customer.login');
// Customer ログイン
Route::post('/customer/login', [LoginController::class, 'store'])->name('customer.login.store');
// Customer ログアウト
Route::post('/customer/logout', [LoginController::class, 'destroy'])
                ->name('customer.logout');

// Customer ログイン後のみアクセス可
Route::middleware('auth:customer')->prefix('customer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
});