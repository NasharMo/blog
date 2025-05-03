<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexPostRequest;
use App\Http\Requests\PaginatedIndexRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Services\ApiResponseService;
use App\Services\PostService;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Posts extends Controller
{
    public function __construct(private PostService $postService) {}


    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Get list of posts",
     *     tags={"Posts"},
     *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/PostListResponse")),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function index(IndexPostRequest $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $categorySlug = $request->input('category', null);

        $posts = $this->postService->getAll($perPage, $page, [
            'category' => $categorySlug,
        ]);

        return ApiResponseService::create('success', 'Posts retrieved successfully', $posts, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="Get a single post",
     *     tags={"Posts"},
     *     @OA\Parameter(name="id", in="path", required=true, description="Post ID", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/SinglePostResponse")),
     *     @OA\Response(response=404, description="Post not found"),
     *     @OA\Response(response=422, description="Validation errors")
     * )
     */
    public function show(Post $post)
    {
        return ApiResponseService::create('success', 'Post retrieved successfully', $post, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Create a new post",
     *     tags={"Posts"},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/PostRequest")),
     *     @OA\Response(response=201, description="Post created successfully", @OA\JsonContent(ref="#/components/schemas/SinglePostResponse")),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->postService->create($request->validated());

        return ApiResponseService::create('success', 'Post created successfully', $post, HttpFoundationResponse::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     summary="Update an existing post",
     *     tags={"Posts"},
     *     @OA\Parameter(name="id", in="path", required=true, description="Post ID", @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/PostRequest")),
     *     @OA\Response(response=200, description="Post updated successfully", @OA\JsonContent(ref="#/components/schemas/SinglePostResponse")),
     *     @OA\Response(response=404, description="Post not found"),
     *     @OA\Response(response=422, description="Validation errors")
     * )
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $post = $this->postService->update($post, $request->validated());

        return ApiResponseService::create('success', 'Post updated successfully', $post, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     summary="Delete a post",
     *     tags={"Posts"},
     *     @OA\Parameter(name="id", in="path", required=true, description="Post ID", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Post deleted successfully"),
     *     @OA\Response(response=404, description="Post not found"),
     * )
     */
    public function destroy(Post $post)
    {
        $this->postService->delete($post);
        return ApiResponseService::create('success', 'Post deleted successfully', null, HttpFoundationResponse::HTTP_OK);
    }
}
