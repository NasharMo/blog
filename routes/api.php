<?php

use App\Http\Controllers\Categories;
use App\Http\Controllers\Posts;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [Posts::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [Posts::class, 'show'])->name('posts.show');

Route::get('/categories', [Categories::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [Categories::class, 'show'])->name('categories.show');
Route::post('/categories', [Categories::class, 'store'])->name('categories.store');
Route::put('/categories/{category:slug}', [Categories::class, 'update'])->name('categories.update');
Route::delete('/categories/{category:slug}', [Categories::class, 'destroy'])->name('categories.destroy');