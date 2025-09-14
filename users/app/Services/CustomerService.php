<?php

namespace App\Services;

use App\DTOs\CustomerData;
use App\Events\CustomerCreated;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\DB;

readonly class CustomerService
{
    public function __construct(
        private CustomerRepository $customers
    )
    {}

    public function create(string $name, string $surname, string $email): void
    {
        DB::transaction(function () use ($name, $surname, $email) {
            $password = 'password';

            $customer = $this->customers->create(name: $name, surname: $surname, email: $email, password: $password);
            $customerData = CustomerData::fromModel($customer, $password);

            CustomerCreated::dispatch($customerData);
        });
    }
}
