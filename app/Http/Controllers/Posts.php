<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use PostService;

class Posts extends Controller
{
    public function index(Request $request) {
        // Fetch all posts from the database
        $posts = Post::with('category')->get();

        // Return the posts as a JSON response
        return response()->json($posts);
    }
}
