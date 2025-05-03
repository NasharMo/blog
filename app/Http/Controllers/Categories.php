<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginatedIndexRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\ApiResponseService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Categories extends Controller
{
    public function __construct(private CategoryService $CategoryService) {
       
    }

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Get list of categories",
     *     tags={"Categories"},
     *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/CategoryListResponse")),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function index(PaginatedIndexRequest $request) {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $categories = $this->CategoryService->getAll($perPage, $page);

        return ApiResponseService::create('success', 'Categories retrieved successfully', $categories, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{slug}",
     *     summary="Get a single category",
     *     tags={"Categories"},
     *     @OA\Parameter(name="id", in="path", required=true, description="Category ID", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/SingleCategoryResponse")),
     *     @OA\Response(response=404, description="Category not found"),
     *     @OA\Response(response=422, description="Validation errors")
     * )
     */
    public function show(Category $category) {
        return ApiResponseService::create('success', 'Category retrieved successfully', $category, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Create a new category",
     *     tags={"Categories"},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CategoryRequest")),
     *     @OA\Response(response=201, description="Category created successfully", @OA\JsonContent(ref="#/components/schemas/SingleCategoryResponse")),
     *     @OA\Response(response=422, description="Validation errors")
     * )
     */
    public function store(StoreCategoryRequest $request) {
        $category = $this->CategoryService->create($request->validated());    // $request->validated() will return the validated data from the request without any extra attributes.

        return ApiResponseService::create('success', 'Category created successfully', $category, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{slug}",
     *     summary="Update an existing category",
     *     tags={"Categories"},
     *     @OA\Parameter(name="id", in="path", required=true, description="Category ID", @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CategoryRequest")),
     *     @OA\Response(response=200, description="Category updated successfully", @OA\JsonContent(ref="#/components/schemas/SingleCategoryResponse")),
     *     @OA\Response(response=422, description="Validation errors")
     * )
     */
    public function update(UpdateCategoryRequest $request, Category $category) {
        $category = $this->CategoryService->update($category, $request->validated());

        return ApiResponseService::create('success', 'Category updated successfully', $category, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{slug}",
     *     summary="Delete a category",
     *     tags={"Categories"},
     *     @OA\Parameter(name="id", in="path", required=true, description="Category ID", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Category deleted successfully"),
     *     @OA\Response(response=404, description="Category not found"),
     * )
     */
    public function destroy(Category $category) {
        $this->CategoryService->delete($category);
        return ApiResponseService::create('success', 'Category deleted successfully', null, Response::HTTP_OK);
    }
}