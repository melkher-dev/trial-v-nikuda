<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'metadata' => 'array',
    ];

    protected $keyType = 'string';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id', 'categories');
    }
}
