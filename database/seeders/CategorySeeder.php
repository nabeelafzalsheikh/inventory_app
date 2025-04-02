<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Electronics', 'status' => 'active'],
            ['name' => 'Clothing', 'status' => 'active'],
            ['name' => 'Home & Garden', 'status' => 'active'],
            ['name' => 'Sports', 'status' => 'active'],
            ['name' => 'Toys', 'status' => 'inactive'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create additional random categories
        Category::factory()->count(5)->create();
    }
}