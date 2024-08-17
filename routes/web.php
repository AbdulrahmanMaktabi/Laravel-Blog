<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/category/{id?}', 'category')->name('category');
    // Route::get('/singleBlog', 'singleBlog')->name('singleBlog');
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');

        Route::post('/login', 'create')->name('login.post');
        Route::post('/register', 'nRegister')->name('register.post');
    });
});

Route::post('/subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');
Route::post('/subscriber/store/1', [SubscriberController::class, 'store2'])->name('subscriber2.store');

Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::resource('blogs', BlogController::class);

Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store');
