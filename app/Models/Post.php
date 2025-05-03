<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Post",
 *     title="Post",
 *     description="Single post model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Sample Title"),
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="content", type="string", example="Post content"),
 *     @OA\Property(property="author", type="string", example="John Doe"),
 *     @OA\Property(property="created_at", type="string", format="date-time", nullable=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", nullable=true)
 * )
 * 
 * @OA\Schema(
 *     schema="PaginatedPost",
 *     title="Paginated Posts",
 *     description="Paginated list of posts",
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Post")
 *     ),
 *     @OA\Property(property="last_page", type="integer", example=1),
 *     @OA\Property(property="per_page", type="integer", example=10),
 *     @OA\Property(property="total", type="integer", example=100),
 *     @OA\Property(property="path", type="string", example="http://localhost/api/posts")
 * )
 * 
 * 
 * @OA\Schema(
 *     schema="PostRequest",
 *     title="Post Request",
 *     description="Data needed to create/update a post",
 *     required={"title", "content", "author"},
 *     @OA\Property(property="title", type="string", example="New Post Title"),
 *     @OA\Property(property="content", type="string", example="Post content here"),
 *     @OA\Property(property="author", type="string", example="Jane Smith"),
 *     @OA\Property(property="category_id", type="integer", example=1)
 * )
 * 
 * @OA\Schema(
 *     schema="SinglePostResponse",
 *     title="Single Post Response",
 *     description="Response wrapper for single post",
 *     @OA\Property(property="status", type="string", example="success"),
 *     @OA\Property(property="message", type="string", example="Post retrieved successfully"),
 *     @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/Post"
 *     )
 * )
 * @OA\Schema(
 *     schema="PostListResponse",
 *     title="Post List Response",
 *     description="Standard API response for post lists",
 *     @OA\Property(property="status", type="string", example="success"),
 *     @OA\Property(property="message", type="string", example="Posts retrieved successfully"),
 *     @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/PaginatedPost"
 *     )
 * )
 *
 */

class Post extends Model
{
    protected $fillable = ['title', 'content', 'author'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
