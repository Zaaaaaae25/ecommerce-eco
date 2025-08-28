<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Organic Rice 5kg', 'description' => 'Healthy organic rice 5kg', 'price' => 120000, 'stock' => 50, 'category_id' => 1],
            ['name' => 'Eco Water Bottle', 'description' => 'Reusable eco-friendly bottle', 'price' => 45000, 'stock' => 100, 'category_id' => 2],
            ['name' => 'Bamboo Toothbrush', 'description' => 'Eco-friendly bamboo toothbrush', 'price' => 15000, 'stock' => 200, 'category_id' => 3],
            ['name' => 'Organic Cotton T-shirt', 'description' => 'Comfortable organic cotton t-shirt', 'price' => 99000, 'stock' => 80, 'category_id' => 4],
            ['name' => 'Solar Power Bank', 'description' => 'Portable solar power bank 10000mAh', 'price' => 250000, 'stock' => 40, 'category_id' => 5],
            ['name' => 'Herbal Shampoo', 'description' => 'Natural herbal shampoo 250ml', 'price' => 60000, 'stock' => 70, 'category_id' => 6],
            ['name' => 'Yoga Mat Eco', 'description' => 'Eco-friendly yoga mat', 'price' => 175000, 'stock' => 30, 'category_id' => 7],
            ['name' => 'Recycled Notebook', 'description' => 'Notebook from recycled paper', 'price' => 25000, 'stock' => 120, 'category_id' => 10],
            ['name' => 'Wooden Toy Car', 'description' => 'Handmade eco wooden toy car', 'price' => 50000, 'stock' => 60, 'category_id' => 9],
            ['name' => 'Eco Book: Sustainable Living', 'description' => 'Guidebook for sustainable lifestyle', 'price' => 75000, 'stock' => 35, 'category_id' => 8],
        ];

        foreach ($products as $i => $p) {
            Product::create([
                'name'        => $p['name'],
                'slug'        => Str::slug($p['name']) . '-' . ($i+1), // isi slug bila NOT NULL
                'description' => $p['description'],
                'price'       => $p['price'],
                'stock'       => $p['stock'],
                'category_id' => $p['category_id'],
                'image'       => 'https://via.placeholder.com/300x200',
                // isi juga kolom NOT NULL lain seperti 'sku' jika ada:
                // 'sku' => 'SKU-' . str_pad((string)($i+1), 4, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
