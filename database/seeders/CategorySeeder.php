<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB Facade
use App\Models\Category; // Import Category Model

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus data lama untuk menghindari duplikat
        Category::truncate();

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Data kategori untuk produk daur ulang
        $categories = [
            [
                'name' => 'Aksesoris Fesyen Unik',
                'slug' => 'aksesoris-fesyen-unik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dekorasi Rumah Artistik',
                'slug' => 'dekorasi-rumah-artistik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peralatan Kantor & Organizer',
                'slug' => 'peralatan-kantor-organizer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mainan Edukasi Anak',
                'slug' => 'mainan-edukasi-anak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Masukkan data ke dalam tabel 'categories'
        Category::insert($categories);
=======
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
>>>>>>> 3edd9c4383a05f026460656cb34929f3a385b9c3
    }
}
