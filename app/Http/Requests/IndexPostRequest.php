<?php

namespace App\Http\Requests;

class IndexPostRequest extends PaginatedIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'category' => 'sometimes|exists:categories,slug|min:2',
        ]);
    }

    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'category.exists' => 'The selected category is not found.',
        ]);
    }
}
