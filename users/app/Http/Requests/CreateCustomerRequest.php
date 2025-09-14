<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Traits\ResponseHelperTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateCustomerRequest extends FormRequest
{
    use ResponseHelperTrait;

    public function getName(): ?string
    {
        return $this->input('name');
    }

    public function getSurname(): ?string
    {
        return $this->input('surname');
    }

    public function getEmail(): ?string
    {
        return $this->input('email');
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique(Customer::TABLE_NAME, 'email')],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->responseError(data: $validator->errors()->toArray()));
    }
}
