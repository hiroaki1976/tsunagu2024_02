<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;

// Admin 認証不要
// Route::group(['prefix' => 'admin'], function() {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// });

// Admin ログイン画面
Route::get('/admin/login', [LoginController::class, 'create'])->name('admin.login');
// Admin ログイン
Route::post('/admin/login', [LoginController::class, 'store'])->name('admin.login.store');
// Admin ログアウト
Route::post('/admin/logout', [LoginController::class, 'destroy'])
                ->name('admin.logout');

// Admin ログイン後のみアクセス可
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});