<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// 首页
Route::get('/', [HomeController::class, 'index'])->name('home');

// 认证路由
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// 帖子相关路由
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
    Route::post('/', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/{post}/like', [PostController::class, 'like'])->middleware('auth')->name('posts.like');
});

// 评论相关路由
Route::middleware('auth')->prefix('comments')->group(function () {
    Route::post('/', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// 用户相关路由
Route::prefix('users')->group(function () {
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/{user}/follow', [UserController::class, 'follow'])
        ->middleware('auth')
        ->name('users.follow');
}); 