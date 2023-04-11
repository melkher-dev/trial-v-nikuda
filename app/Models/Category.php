<?php

namespace App\Models;

use App\UuidTrait;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, UuidTrait;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id', 'products');
    }
}
