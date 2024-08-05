<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CKEditorController;

use App\Http\Middleware\RedirectIfAuthenticated;

Route::middleware(RedirectIfAuthenticated::class)->group(function() {
    Route::get('/signin', [AuthController::class, 'getSignin'])->name('get.signin');
    Route::post('/auth/signin', [AuthController::class, 'postSignin'])->name('post.signin');
});

Route::get('/signout', [AuthController::class, 'getSignout'])->name('get.signout');

Route::resource('articles', ArticleController::class)->except(['show']);
Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');

Route::post('/ckeditor/upload', CKEditorController::class)->name('ckeditor.upload');
