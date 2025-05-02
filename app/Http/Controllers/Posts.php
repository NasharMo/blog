<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class Posts extends Controller
{
    public function __construct(private PostService $postService) {
        
    }

    public function index(Request $request) {
        $posts = $this->postService->getAll();

        return response()->json($posts);
    }
}
