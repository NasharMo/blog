<?php

namespace App\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = $this->route('category')->id;

        return [
            'name' => 'sometimes|string|unique:categories,name,' . $categoryId . '|max:255',
            'slug' => 'sometimes|string|unique:categories,slug,' . $categoryId . '|max:255|regex:/^[a-zA-Z0-9\-]+$/',
            'description' => 'sometimes|nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already been taken.',
            'slug.regex' => 'The slug may only contain letters, numbers, and dashes.',
            'slug.unique' => 'The slug has already been taken.',
        ];
    }

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
