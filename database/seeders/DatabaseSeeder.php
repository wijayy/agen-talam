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
            // Transaksi::factory(1)->recycle($user)->create();
        }

        $faq = [
            [
                'question' => "Berapa biaya paket wisata ke Pulau Menjangan?",
                'answer'=> "Biaya paket adalah Rp500.000 per orang, sudah termasuk transport, makan siang, dan tiket masuk."
            ],
            [
                'question' => "Apakah tersedia layanan penjemputan?",
                'answer'=> "Ya, tersedia gratis penjemputan untuk area Singaraja. Untuk peserta dari luar Singaraja, wajib datang ke markas keberangkatan di Singaraja."
            ],
            [
                'question' => "Jam berapa penjemputan dilakukan?",
                'answer'=> "Penjemputan hotel/villa dilakukan pada pukul 07.30 – 08.00 WITA."
            ],
            [
                'question' => "Berapa lama estimasi perjalanan wisata?",
                'answer'=> "Perjalanan memakan waktu sekitar 1 hari penuh, dengan estimasi:

Singaraja/Lovina → Pelabuhan: ± 1 jam 20 menit,

Boat ke Pulau Menjangan: ± 20 menit,

Aktivitas laut (snorkeling/diving): 2 sesi @ 30 menit,

Istirahat & santai di pulau: ± 30 menit,"
            ],
            [
                'question' => "Apa saja fasilitas yang didapat dalam paket ini?",
                'answer'=> "Peserta akan mendapatkan transportasi, makan siang, tiket masuk, serta kesempatan menikmati snorkeling/diving di Pulau Menjangan."
            ],
        ];

        foreach ($faq as $key => $item) {
            FaQ::factory()->create($item);
        }


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

        Setting::create([
            'key' => 'harga', 'value' => '500',
        ]);
        Setting::create([
            'key' => 'alamat', 'value' => 'Jl. Menjangan Bahagia',
        ]);
        Setting::create([
            'key' => 'nomor_telepon', 'value' => '081234567890',
        ]);
    }
}
