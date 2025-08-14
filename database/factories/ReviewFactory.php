<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'transaksi_id' => Transaksi::factory(),
            'rate' => mt_rand(1, 5),
            'review' => fake()->paragraph(),
            'show' => true,
        ];
    }
}
