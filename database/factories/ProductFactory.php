<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory()->create()->id,
            'title' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'description' => $this->faker->paragraph(),
            'metadata' => [
                'color' => $this->faker->colorName(),
                'weight' => $this->faker->randomFloat(2, 0.5, 2),
            ],
            'deleted_at' => null,
        ];
    }
}
