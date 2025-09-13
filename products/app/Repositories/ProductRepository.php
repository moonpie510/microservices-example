<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

readonly class ProductRepository
{
    public function getAll(): Collection
    {
        return Product::query()->get();
    }

    public function getById(int $id): ?Product
    {
        return Product::query()->where('id', $id)->first();
    }

    public function create(Category $category, string $title, float $price): Product
    {
        if ($price <= 0) {
            throw new \Exception('Цена должна быть больше 0');
        }

        return Product::query()->create(['title' => $title, 'category_id' => $category->id, 'price' => $price]);
    }
}
