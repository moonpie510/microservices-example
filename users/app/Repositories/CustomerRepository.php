<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

readonly class CustomerRepository
{
    public function getAll(): Collection
    {
        return Customer::query()->get();
    }

    public function getById(int $id): ?Customer
    {
        return Customer::query()->where('id', $id)->first();
    }

    public function create(string $name, string $surname, string $email, $password): Customer
    {
        return Customer::query()->create(['name' => $name, 'surname' => $surname, 'email' => $email, 'password' => $password]);
    }
}
