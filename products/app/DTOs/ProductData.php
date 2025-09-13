<?php

namespace App\DTOs;

use App\Models\Product;
use App\ValueObjects\Price;

readonly class ProductData
{
    public function __construct(
        public ?int $id,
        public string $title,
        public CategoryData $category,
        public Price $price,
    )
    {}

    public static function fromModel(Product $product): self
    {
        return new self(
            id: $product->id,
            title: $product->title,
            category: CategoryData::fromModel($product->category),
            price: Price::fromFloat($product->price)
        );
    }
}
