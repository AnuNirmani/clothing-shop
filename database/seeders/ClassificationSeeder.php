<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classification;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classifications = [
            'Premium',
            'Standard',
            'Economy',
            'Luxury',
            'Budget',
            'Designer',
            'Classic',
            'Modern',
        ];

        foreach ($classifications as $classificationName) {
            Classification::createClassification(['name' => $classificationName]);
        }
    }
}
