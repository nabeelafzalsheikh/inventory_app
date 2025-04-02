<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Samsung'],
            ['name' => 'Apple'],
            ['name' => 'Nike'],
            ['name' => 'Adidas'],
            ['name' => 'Sony'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Create additional random brands
        Brand::factory()->count(5)->create();
    }
}