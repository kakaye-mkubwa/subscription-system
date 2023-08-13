<?php

namespace Database\Factories;

use App\Models\SubscriptionWebsites;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscriptionWebsiteID = $this->faker->numberBetween(1, SubscriptionWebsites::all()->count() - 1);
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'post_date' => $this->faker->date,
            'author' => $this->faker->name,
            'url' => $this->faker->url,
            'subscription_website_id' => $subscriptionWebsiteID,
        ];
    }
}
