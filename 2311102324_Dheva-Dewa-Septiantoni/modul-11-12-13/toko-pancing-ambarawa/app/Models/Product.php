<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Field apa saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'description'
    ];
}