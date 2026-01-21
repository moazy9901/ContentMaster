<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'keywords',
        'description',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
