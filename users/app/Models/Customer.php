<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public const TABLE_NAME = 'customers';
    protected $table = self::TABLE_NAME;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = ['password' => 'hashed'];
    protected $hidden = ['password', 'created_at', 'updated_at'];
}
