<?php

namespace App\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class PaginatedIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'perPage' => 'integer|min:1|max:100',
            'page' => 'integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'perPage.integer' => 'The perPage must be an integer.',
            'perPage.min' => 'The perPage must be at least 1.',
            'perPage.max' => 'The perPage may not be greater than 100.',
            'page.integer' => 'The page must be an integer.',
            'page.min' => 'The page must be at least 1.',
        ];
    }

    // This will override the default failedValidation method and the exception handling method defined in bootstrap/app.php.
    // Also, this returns a JSON response even if no Accept: application/json header is set and prevetnts returning an HTML page.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ApiResponseService::create(
            'error',
            'The given data was invalid.',
            $validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
