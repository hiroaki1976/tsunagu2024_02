<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::resource('bbs', PostsController::class, ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);

// Route::get('/bbs', [PostsController::class, 'index'])->name('bbs.index');

Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');

Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');

Route::resource('comment', 'CommentsController', ['only' => ['store']]);

Route::post('/comment', [CommentsController::class, 'store'])->name('comment.store');

Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/customer.php';
