<?php

namespace Database\Factories;

use App\Models\Category;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'categoryId' => function () {
                return Category::factory()->create()->id;
            }, 
            'description' => $this->faker->paragraph(),
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber(),
            'img' => $this->faker->image('public/images', 640, 480, null, false),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
}
