<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginatedIndexRequest;
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
}
