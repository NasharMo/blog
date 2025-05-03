<?php

namespace App\Http\Requests;

use App\Http\Requests\PaginatedIndexRequest;

class IndexActivityLogRequest extends PaginatedIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'action' => 'sometimes|string',
            'entity' => 'sometimes|string',
            'date_from' => 'sometimes|date_format:Y-m-d',
            'date_to' => 'sometimes|date_format:Y-m-d',
        ]);
    }

    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'action.string' => 'The action must be a string.',
            'entity.string' => 'The entity must be a string.',
            'date_from.date_format' => 'The date from must be in the format Y-m-d.',
            'date_to.date_format' => 'The date to must be in the format Y-m-d.',
        ]);
    }
}