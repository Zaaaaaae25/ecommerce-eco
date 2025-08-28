<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Food',
            'Beverages',
            'Household',
            'Fashion',
            'Electronics',
            'Health & Beauty',
            'Sports',
            'Books',
            'Toys',
            'Office Supplies',
        ];

        foreach ($categories as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . ($i+1), // jaga unik kalau ada unique index
            ]);
        }
    }
}
