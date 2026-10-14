<?php

use App\Livewire\ArticleForm;
use App\Livewire\CategoryForm;
use App\Livewire\EntityForm;
use App\Livewire\LinkForm;
use Illuminate\Support\Facades\Route;

Route::get('/category/create', CategoryForm::class)
    ->middleware(['auth', 'verified'])
    ->name('category-show-create-form');

Route::get('/article/create', ArticleForm::class)
    ->middleware(['auth', 'verified'])
    ->name('article-show-create-form');

Route::get('/article/{article}', ArticleForm::class)
    ->middleware(['auth', 'verified'])
    ->name('article-show-update-form');

Route::get('/entity/create', EntityForm::class)
    ->middleware(['auth', 'verified'])
    ->name('entity-show-create-form');

// Authenticated dashboard route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'dashboard')
        ->name('home');

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

    Route::get('/link', LinkForm::class)
        ->middleware(['auth', 'verified'])
        ->name('link-show-form');

    //    Route::get('/dashboard', function () {
    //        return view('dashboard');
    //    })->name('dashboard');
    // s
    //    // Example profile routes
    //    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
