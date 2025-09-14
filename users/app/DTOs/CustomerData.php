<?php

namespace App\DTOs;

use App\Models\Customer;

class CustomerData
{
    public function __construct(
        public string $name,
        public string $surname,
        public string $email,
        public ?string $password,
    )
    {}

    public static function fromModel(Customer $customer, ?string $password = null): self
    {
        return new self(
            $customer->name,
            $customer->surname,
            $customer->email,
            $password
        );
    }

    public function toJson(): string
    {
        return json_encode([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'password' => $this->password,
        ]);
    }
}
