<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Food', 'Travel', 'Sports', 'Locations'];
        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }
}
