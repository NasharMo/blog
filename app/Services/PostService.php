<?php

namespace App\Services;

use App\Models\Post;

class PostService {
    public function getAll() {
        return Post::with('category')->get();
    }
}