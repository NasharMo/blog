<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginatedIndexRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\ApiResponseService;
use App\Services\CategoriesService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Categories extends Controller
{
    public function __construct(private CategoriesService $categoriesService) {
       
    }

    public function index(PaginatedIndexRequest $request) {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $categories = $this->categoriesService->getAll($perPage, $page);

        return ApiResponseService::create('success', 'Categories retrieved successfully', $categories, Response::HTTP_OK);
    }

    public function show(Category $category) {
        return ApiResponseService::create('success', 'Category retrieved successfully', $category, Response::HTTP_OK);
    }

    public function store(StoreCategoryRequest $request) {
        $category = $this->categoriesService->create($request->validated());    // $request->validated() will return the validated data from the request without any extra attributes.

        return ApiResponseService::create('success', 'Category created successfully', $category, Response::HTTP_CREATED);
    }

    public function update(UpdateCategoryRequest $request, Category $category) {
        $category = $this->categoriesService->update($category, $request->validated());

        return ApiResponseService::create('success', 'Category updated successfully', $category, Response::HTTP_OK);
    }

    public function destroy(Category $category) {
        $this->categoriesService->delete($category);
        return ApiResponseService::create('success', 'Category deleted successfully', null, Response::HTTP_OK);
    }
}