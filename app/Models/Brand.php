<?php

namespace App\Models;

use App\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, UuidTrait;

    protected $guarded = ['id'];
}
