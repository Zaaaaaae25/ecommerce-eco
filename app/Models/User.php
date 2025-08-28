<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = [
        'name','email','password','role','address','phone'
    ];

    protected $hidden = ['password'];

    /** Baris pivot wishlist milik user */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }

    /** Relasi langsung ke Product (many-to-many via wishlists) */
    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'wishlists', 'user_id', 'product_id')
                    ->withTimestamps();
    }

    /** Helper dipakai di Blade */
    public function hasInWishlist(int $productId): bool
    {
        return $this->wishlist()->where('product_id', $productId)->exists();
    }
}
