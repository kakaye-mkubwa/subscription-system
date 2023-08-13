<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSubscription>
 */
class UserSubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentStatus = $this->faker->randomElement(['active', 'inactive', 'expired']);
        $userId = $this->faker->numberBetween(1, 1000);
        $subscriptionWebsiteId = $this->faker->numberBetween(1, 1000);

        return [
            'user_id' => $userId,
            'subscription_website_id' => $subscriptionWebsiteId,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'payment_status' => $paymentStatus,
        ];
    }
}
