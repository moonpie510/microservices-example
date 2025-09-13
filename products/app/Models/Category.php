<?php

namespace App\Models;

use App\DTOs\CategoryData;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public const TABLE_NAME = 'categories';
    protected $table = self::TABLE_NAME;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function toContainer(): CategoryData
    {
        return CategoryData::fromModel($this);
    }
}
