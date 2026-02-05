<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['name' => 'frock'],
            ['name' => 'trousers'],
            ['name' => 'saree'],
            ['name' => 'kurta'],
            ['name' => 'blouse'],
            ['name' => 'suit'],
            ['name' => 'salwar kameez'],
            ['name' => 'lehenga'],
        ];

        foreach ($sizes as $size) {
            \App\Models\Size::create($size);
        }
    }
}
