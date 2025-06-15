<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];
}
