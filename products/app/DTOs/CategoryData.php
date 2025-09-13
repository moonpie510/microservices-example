<?php

namespace App\DTOs;

use App\Models\Category;

readonly class CategoryData
{
    public function __construct(
        public int $id,
        public string $title,
    )
    {}

    public static function fromModel(Category $category): static
    {
        return new static(id: $category->id, title: $category->title);
    }
}
