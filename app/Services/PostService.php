<?php

namespace App\Services;

use App\Models\Post;

class PostService {
    public function getAll(int $perPage = 10, int $page = 1, array $filters = []) {
        $query = Post::query();

        if (!empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(array $data) {
        return Post::create($data);
    }

    public function update(Post $post, array $data) {
        $post->update($data);
        return $post;
    }

    public function delete(Post $post) {
        $post->delete();
    }
}