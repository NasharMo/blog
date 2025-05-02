<?php

namespace App\Services;

use App\Models\Category;

class CategoriesService
{
    public function getAll(int $perPage = 10, int $page = 1)
    {
        return Category::paginate($perPage, ['*'], 'page', $page);
    }

    public function getById(int $id)
    {
        return Category::findOrFail($id);
    }
}