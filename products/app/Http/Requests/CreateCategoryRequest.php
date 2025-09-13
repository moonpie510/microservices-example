<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    use ResponseTrait;

    public function getTitle(): ?string
    {
        return $this->input('title');
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', Rule::unique(Category::TABLE_NAME, 'title')],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->responseError(data: $validator->errors()->toArray()));
    }
}
