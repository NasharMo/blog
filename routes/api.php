<?php

use App\Http\Controllers\ActivityLogs;
use App\Http\Controllers\Categories;
use App\Http\Controllers\Posts;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [Posts::class, 'index'])->name('posts.index');
    Route::get('/{post}', [Posts::class, 'show'])->name('posts.show');
    Route::post('/', [Posts::class, 'store'])->name('posts.store');
    Route::put('/{post}', [Posts::class, 'update'])->name('posts.update');
    Route::delete('/{post}', [Posts::class, 'destroy'])->name('posts.destroy');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [Categories::class, 'index'])->name('categories.index');
    Route::get('/{category:slug}', [Categories::class, 'show'])->name('categories.show');
    Route::post('/', [Categories::class, 'store'])->name('categories.store');
    Route::put('/{category:slug}', [Categories::class, 'update'])->name('categories.update');
    Route::delete('/{category:slug}', [Categories::class, 'destroy'])->name('categories.destroy');
});
