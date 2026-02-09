<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'images',
        'slug',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
