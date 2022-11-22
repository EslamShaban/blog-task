<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\CommentController;

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

Route::middleware(['auth'])->group(function(){
        
    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::prefix('posts')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{slug}', [PostController::class, 'show'])->name('posts.show');
        Route::post('/{post}/toggle_like', [PostController::class, 'toggle_like'])->name('posts.toggle_like');

        Route::post('/{post}/store_comment', [CommentController::class, 'store'])->name('comment.store');

    });


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
