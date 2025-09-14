<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

readonly class CustomerService
{
    public function __construct(
        private CustomerRepository $customers
    )
    {}

    public function create(string $name, string $surname, string $email): void
    {
        $password = 'password';

        $this->customers->create(name: $name, surname: $surname, email: $email, password: $password);
    }
}
