<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

readonly class CategoryRepository
{
    public function getAll(): Collection
    {
        return Category::query()->get();
    }

    public function getById(int $id): ?Category
    {
        return Category::query()->where('id', $id)->first();
    }

    public function create(string $title): Category
    {
        return Category::query()->create(['title' => $title]);
    }
}
