<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ArticleFilterRequest extends FormRequest
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
            'category' => 'nullable|string|max:100',
            'source' => 'nullable|in:news_api,news_cred,open_news',
            'author' => 'nullable|string|max:255',
            'date' => 'nullable|date_format:Y-m-d',
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|min:1|max:100',
            'orderBy' => 'nullable|in:published_at,title,created_at',
            'direction' => 'nullable|in:asc,desc',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'source.in' => 'The selected source must be one of: news_api, news_cred, or open_news.',
            'date.date_format' => 'The date must be in the format: YYYY-MM-DD.',
            'perPage.integer' => 'The perPage must be a valid number.',
            'perPage.min' => 'The perPage must be at least 1.',
            'perPage.max' => 'The perPage must not exceed 100.',
            'orderBy.in' => 'The orderBy field must be one of: published_at, title, or created_at.',
            'direction.in' => 'The direction must be either asc or desc.',
        ];
    }

    /**
     * Handle a failed validation attempt for API.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}

