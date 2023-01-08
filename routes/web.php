<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

/**
 * posts
 */
Route::get('/', [PostController::class, 'index'])->name('home');
Route::resource('posts', PostController::class);

/**
 * comments
 */
Route::resource('comments', CommentController::class);

/**
 * users
 */

Route::get('/email/verify', function () {
    return view('users.email-verification.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/users/create', [UserController::class, 'store'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::patch('/users/{user}', [UserController::class, 'update'])->middleware('auth');
Route::get('/users/{user}/posts', [UserController::class, 'user_posts'])->middleware('auth');
Route::get('/users/{user}/comments', [UserController::class, 'user_comments'])->middleware('auth');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth');
// ADMIN
Route::get('/admin/users', [UserController::class, 'admin_users'])->middleware('admin');
Route::get('/admin/posts', [UserController::class, 'admin_posts'])->middleware('admin');
Route::get('/admin/comments', [UserController::class, 'admin_comments'])->middleware('admin');


