<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionWebsites>
 */
class SubscriptionWebsitesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'website_name' => $this->faker->unique()->word(),
            'website_url' => $this->faker->unique()->url(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 0, 100000),
            'duration_in_months' => $this->faker->numberBetween(1, 12),
        ];
    }
}
