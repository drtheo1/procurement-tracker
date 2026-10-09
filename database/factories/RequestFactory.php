<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'quantity' => fake()->numberBetween(1, 20),
            'estimated_cost' => fake()->randomFloat(2, 10, 5000),
            'status' => 'pending',
            'request_date' => now()->toDateString(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
