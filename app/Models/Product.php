<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock', 'image', 'eco_score',
        'category_id', // ✅ pakai FK id, bukan slug
    ];

    // (Opsional) kalau suatu saat kolom2 ini jadi JSON
    protected $casts = [
        'images' => 'array',
        'sizes'  => 'array',
        'colors' => 'array',
    ];

    /** Baris pivot wishlist yg menunjuk product ini */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    /** User yang me-wishlist product ini */
    public function wishlistedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id')
                    ->withTimestamps();
    }

    /** Relasi kategori via FK id */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id'); // ✅
    }
}
