<?php

use App\Http\Controllers\Community\CreateController;
use App\Http\Controllers\Community\SubscriptionCommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\CreateControler;
use App\Http\Middleware\ShareUserSubscriptions;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Комюнити
Route::middleware('auth')->prefix('community')->as('community.')->group(function () {
    Route::get('/subscriptions', SubscriptionCommunityController::class)->name('subscriptions');
    Route::get('/create', [CreateController::class, 'create'])->name('create');
    Route::post('/', [CreateController::class, 'store'])->name('store');
});

//Посты
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [CreateControler::class, 'create'])->name('posts.create');
    Route::post('/posts', [CreateControler::class, 'store'])->name('posts.store');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
