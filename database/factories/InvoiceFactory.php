<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $issue_date = $this->faker->date();
        $due_date = Carbon::parse($issue_date)->addDays(3);
        return [
            'user_subscription_id' => $this->faker->numberBetween(1, 1000),
            'issue_date' => $issue_date,
            'due_date' => $due_date,
            'amount' => $this->faker->randomFloat(2, 0, 100000),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid']),
        ];
    }
}
