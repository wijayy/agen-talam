<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $int = mt_rand(1, 10);
        return [
            'nomor_transaksi' => "AT" . fake()->date('Ymd') . fake()->toUpper(fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter()),
            'user_id' => User::factory(),
            'pax' => $int,
            'total' => $int * 500000,
            'address' => mt_rand(1, 10) > 8 ? fake()->address() : null,
            'date' => Carbon::now()->subDays(15)->addDays(rand(0, 30)),
            'whatsapp' => fake()->phoneNumber()
        ];
    }
}
