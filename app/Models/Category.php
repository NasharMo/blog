<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Category",
 *     title="Category",
 *     description="Single category model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Tech"),
 *     @OA\Property(property="slug", type="string", example="tech"),
 *     @OA\Property(property="description", type="string", example="Technology-related posts"),
 *     @OA\Property(property="created_at", type="string", format="date-time", nullable=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", nullable=true)
 * )
 *
 * @OA\Schema(
 *     schema="PaginatedCategory",
 *     title="Paginated Categories",
 *     description="Paginated list of categories",
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Category")
 *     ),
 *     @OA\Property(property="last_page", type="integer", example=1),
 *     @OA\Property(property="per_page", type="integer", example=10),
 *     @OA\Property(property="total", type="integer", example=100),
 *     @OA\Property(property="path", type="string", example="http://localhost/api/categories")
 * )
 *
 * @OA\Schema(
 *     schema="CategoryRequest",
 *     title="Category Request",
 *     description="Data needed to create/update a category",
 *     required={"name", "slug"},
 *     @OA\Property(property="name", type="string", example="Tech"),
 *     @OA\Property(property="slug", type="string", example="tech"),
 *     @OA\Property(property="description", type="string", example="Optional description here")
 * )
 *
 * @OA\Schema(
 *     schema="SingleCategoryResponse",
 *     title="Single Category Response",
 *     description="Response wrapper for single category",
 *     @OA\Property(property="status", type="string", example="success"),
 *     @OA\Property(property="message", type="string", example="Category retrieved successfully"),
 *     @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/Category"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="CategoryListResponse",
 *     title="Category List Response",
 *     description="Standard API response for category lists",
 *     @OA\Property(property="status", type="string", example="success"),
 *     @OA\Property(property="message", type="string", example="Categories retrieved successfully"),
 *     @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/PaginatedCategory"
 *     )
 * )
 */

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
