<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{
    use ResponseTrait;

    public function getTitle(): ?string
    {
        return $this->input('title');
    }

    public function getCategoryId(): ?string
    {
        return $this->input('category_id');
    }

    public function getPrice(): ?float
    {
        return $this->input('price');
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'category_id' => ['required', Rule::exists(Category::TABLE_NAME, 'id')],
            'price' => ['required', 'numeric', 'gte:1'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->responseError(data: $validator->errors()->toArray()));
    }
}
