<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'contact_person_name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->unique()->numerify('###########'),
        ];
    }
}