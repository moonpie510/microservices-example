<?php

namespace App\Services;

use App\DTOs\CategoryData;
use App\DTOs\ProductData;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Collection as SupportCollection;

readonly class ProductService
{
    public function __construct(
        private ProductRepository $products
    )
    {}

    public function getAll(): SupportCollection
    {
        return $this->products->getAll()
            ->loadMissing('category')
            ->map(fn(Product $category) => $category->toContainer());
    }

    public function getById(int $id): ?ProductData
    {
        return $this->products->getById($id)?->toContainer();

    }

    public function create(Category $category, string $title, float $price): void
    {
        $this->products->create($category, $title, $price);
    }
}
