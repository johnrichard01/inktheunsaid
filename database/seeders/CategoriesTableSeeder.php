<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Artwork', 'description' => 'Artwork category description']);
        \App\Models\Category::create(['name' => 'Literature', 'description' => 'Literature category description']);

    }
}
