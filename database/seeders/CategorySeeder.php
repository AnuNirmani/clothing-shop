<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Men\'s Wear',
            'Women\'s Wear',
            'Kids Wear',
            'Accessories',
            'Footwear',
            'Activewear',
            'Formal Wear',
            'Casual Wear',
        ];

        foreach ($categories as $categoryName) {
            Category::createCategory(['name' => $categoryName]);
        }
    }
}
