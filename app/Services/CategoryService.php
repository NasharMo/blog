<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAll(int $perPage = 10, int $page = 1)
    {
        return Category::paginate($perPage, ['*'], 'page', $page);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }
    
    public function delete(Category $category) {
        $category->delete();
    }
}