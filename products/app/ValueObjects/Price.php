<?php

namespace App\ValueObjects;

readonly class Price
{
    public float $price;
    public string $prettyPrice;

    public function __construct(float $price)
    {
        $this->price = $price;
        $this->prettyPrice = number_format($price, 0, '.', ' ') . ' руб';
    }

    public static function fromFloat(float $price): self
    {
        return new self(price: $price);
    }
}
