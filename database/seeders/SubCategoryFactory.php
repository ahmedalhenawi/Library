<?php

namespace Database\Seeders;

use App\Models\subCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class subCategoryFactory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         SubCategory::factory(100)->create();

//        foreach (rangea(0,100) as $item)
//         \App\Models\subCategory::factory()->create([
//             'name' => fake()->name(),
//             'is_active' => fake()->numberBetween(0, 1),
//             'category_id' => fake()->numberBetween(0, 2),
//             'img' => 'https://via.placeholder.com/150',
//         ]);
    }
}
