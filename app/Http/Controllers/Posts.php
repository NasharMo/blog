<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostIndexRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class Posts extends Controller
{
    public function __construct(private PostService $postService) {
        
    }

    public function index(PostIndexRequest $request) {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $posts = $this->postService->getAll($perPage, $page);

        return response()->json($posts);
    }
}
