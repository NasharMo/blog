<?php

use App\Http\Controllers\Posts;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [Posts::class, 'index'])->name('posts.index');