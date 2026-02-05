<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ['name' => 'Cotton'],
            ['name' => 'Polyester'],
            ['name' => 'Wool'],
            ['name' => 'Silk'],
            ['name' => 'Denim'],
            ['name' => 'Leather'],
            ['name' => 'Linen'],
            ['name' => 'Nylon'],
            ['name' => 'Spandex'],
            ['name' => 'Rayon'],
        ];

        foreach ($materials as $material) {
            \App\Models\Material::create($material);
        }
    }
}
