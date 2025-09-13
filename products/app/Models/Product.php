<?php

namespace App\Models;

use App\DTOs\ProductData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public const TABLE_NAME = 'products';
    protected $table = self::TABLE_NAME;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function toContainer(): ProductData
    {
        return ProductData::fromModel($this);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
