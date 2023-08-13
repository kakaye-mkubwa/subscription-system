<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
 */
class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => $this->faker->numberBetween(1, 1000),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->text(50),
            'date_paid' => $this->faker->date(),
            'paid_by' => $this->faker->name(),
        ];
    }
}
