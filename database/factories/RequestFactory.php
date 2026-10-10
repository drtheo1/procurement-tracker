<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Request> */
class RequestFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->word().' '.fake()->word().' '.fake()->word()),
            'description' => fake()->paragraph(),
            'quantity' => fake()->numberBetween(1, 20),
            'estimated_cost' => fake()->randomFloat(2, 50, 5000),
            'status' => 'pending',
            'request_date' => fake()->dateTimeBetween('-60 days', 'now'),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'approved',
            'decided_at' => now()->subDays(2),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'rejected',
            'decided_at' => now()->subDays(2),
        ]);
    }
}
