<?php

namespace Database\Factories;

use App\Models\Brand;
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
            'title' => $this->faker->words(rand(1, 3), true),
            'description' => $this->faker->paragraph(),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'price' => $this->faker->numberBetween(10, 100000),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
