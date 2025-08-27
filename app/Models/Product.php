<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // app/Models/Product.php

   // app/Models/Product.php
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'image',
    'category_id',
    'slug',
    'eco_score', // <-- TAMBAHKAN INI
];
}