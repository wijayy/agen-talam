<?php

namespace Database\Seeders;

use App\Models\FaQ;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Transaksi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $user = User::factory(1)->create(['email' => "user{$i}@admin.com"]);
            for ($j = 0; $j < 5; $j++) {
                Transaksi::factory(1)->recycle($user)->create();
                $transaksi = Transaksi::factory(1)->recycle($user)->create();
                Review::factory(1)->recycle([User::all(), $transaksi])->create();
            }
        }

        FaQ::factory(10)->create();


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

        Setting::create([
            'key' => 'harga', 'value' => '25000',
        ]);
        Setting::create([
            'key' => 'alamat', 'value' => 'Jl. Menjangan Bahagia',
        ]);
        Setting::create([
            'key' => 'nomor_telepon', 'value' => '081234567890',
        ]);
    }
}
