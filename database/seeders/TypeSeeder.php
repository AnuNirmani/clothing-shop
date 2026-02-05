<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'T-Shirt'],
            ['name' => 'Jeans'],
            ['name' => 'Dress'],
            ['name' => 'Jacket'],
            ['name' => 'Shorts'],
            ['name' => 'Skirt'],
            ['name' => 'Sweater'],
            ['name' => 'Hoodie'],
        ];

        foreach ($types as $type) {
            \App\Models\Type::create($type);
        }
    }
}
