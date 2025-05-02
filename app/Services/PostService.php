<?php

namespace App\Services;

use App\Models\Post;

class PostService {
    public function getAll(int $perPage = 10, int $page = 1) {
        return Post::with('category')->paginate($perPage, ['*'], 'page', $page);
    }
}