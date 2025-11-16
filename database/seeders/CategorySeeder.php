<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar kategori yang ingin Anda buat
        $categories = [
            'Sepatu Formal',
            'Sepatu Kasual',
            'Sepatu Olahraga/Outdoor',
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(['nama' => $categoryName]);
        }
    }
}