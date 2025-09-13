<?php

namespace App\Services;

use App\DTOs\CategoryData;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection as SupportCollection;

readonly class CategoryService
{
    public function __construct(
        private CategoryRepository $categories
    )
    {}

    public function getAll(): SupportCollection
    {
        return $this->categories->getAll()
            ->map(fn(Category $category) => $category->toContainer());
    }

    public function getById(int $id): ?CategoryData
    {
        return $this->categories->getById($id)?->toContainer();
    }

    public function create(string $title): void
    {
        $this->categories->create($title);
    }
}
