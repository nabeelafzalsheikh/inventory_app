<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'category_id' => Category::factory(),
            'sku' => fake()->unique()->word(),
            'price' => fake()->randomFloat(2, 0, 999999.99),
            'brand_id' => Brand::factory(),
            'pieces' => fake()->numberBetween(-10000, 10000),
            'description' => fake()->text(),
            'status' => fake()->randomElement(["instock","outofstock","discount"]),
        ];
    }
}
