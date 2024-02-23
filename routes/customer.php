<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;

// Customer 認証不要
Route::group(['prefix' => 'customer'], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
});