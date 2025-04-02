<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition()
    {
        return [
            'invoice_number' => $this->faker->unique()->numerify('INV-#####'),
            'customer_name' => $this->faker->name,
            'customer_phone' => $this->faker->phoneNumber,
            'grand_total' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}