<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Black',
            'White',
            'Red',
            'Blue',
            'Green',
            'Yellow',
            'Pink',
            'Purple',
            'Orange',
            'Gray',
            'Brown',
            'Navy',
        ];

        foreach ($colors as $colorName) {
            Color::createColor(['name' => $colorName]);
        }
    }
}
