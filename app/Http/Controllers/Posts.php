<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginatedIndexRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Services\ApiResponseService;
use App\Services\PostService;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Posts extends Controller
{
    public function __construct(private PostService $postService) {
        
    }

    public function index(PaginatedIndexRequest $request) {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $posts = $this->postService->getAll($perPage, $page);

        return ApiResponseService::create('success', 'Posts retrieved successfully', $posts, HttpFoundationResponse::HTTP_OK);
    }

    public function show(Post $post) {
        return ApiResponseService::create('success', 'Post retrieved successfully', $post, HttpFoundationResponse::HTTP_OK);
    }

    public function store(StorePostRequest $request) {
        $post = $this->postService->create($request->validated());

        return ApiResponseService::create('success', 'Post created successfully', $post, HttpFoundationResponse::HTTP_CREATED);
    }

    public function update(StorePostRequest $request, Post $post) {
        $post = $this->postService->update($post, $request->validated());

        return ApiResponseService::create('success', 'Post updated successfully', $post, HttpFoundationResponse::HTTP_OK);
    }
    
    public function destroy(Post $post) {
        $this->postService->delete($post);
        return ApiResponseService::create('success', 'Post deleted successfully', null, HttpFoundationResponse::HTTP_OK);
    }
}
