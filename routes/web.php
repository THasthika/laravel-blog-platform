<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'home'])->name('home');

Route::get('/dashboard', [MainController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile-image', [ProfileController::class, 'updateProfileImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');

    Route::get('/notifications', [MainController::class, 'notification'])->name('notification.show');
});

// Post Routes
Route::get('/posts', [PostController::class, 'index'])->name('post.list');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');

// User Routes
Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');

require __DIR__.'/auth.php';
