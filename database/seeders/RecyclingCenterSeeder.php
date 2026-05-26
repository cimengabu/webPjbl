<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecyclingCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel sebelum seeding
        DB::table('recycling_centers')->truncate();

        $centers = [
            [
                'name' => 'Bank Sampah Kitiran Emas - Kertabumi',
                'address' => 'Jl. Dahlia No.27, Purwosari, Kec. Laweyan, Kota Surakarta',
                'latitude' => -7.564516,
                'longitude' => 110.798154,
                'accepted_materials' => ['Plastik', 'Kertas', 'Kardus', 'Logam'],
            ],
            [
                'name' => 'Bank Sampah Merti Bumi',
                'address' => 'Kadipiro, Kec. Banjarsari, Kota Surakarta',
                'latitude' => -7.535805,
                'longitude' => 110.817446,
                'accepted_materials' => ['Plastik', 'Kertas', 'Botol Kaca'],
            ],
            [
                'name' => 'Bank Sampah Kamulyan',
                'address' => 'Jl. Kalimantan, Kestalan, Kec. Banjarsari, Kota Surakarta',
                'latitude' => -7.560410,
                'longitude' => 110.825227,
                'accepted_materials' => ['Plastik', 'Kertas', 'Minyak Jelantah', 'Kardus'],
            ],
            [
                'name' => 'Bank Sampah Mekar Asri',
                'address' => 'Jl. Malabar Tengah, Mojosongo, Kec. Jebres, Kota Surakarta',
                'latitude' => -7.545831,
                'longitude' => 110.840243,
                'accepted_materials' => ['Plastik', 'Kertas', 'Logam', 'Elektronik'],
            ],
            [
                'name' => 'Bank Sampah Guyub Rukun',
                'address' => 'Lemah Abang, Dibal, Kec. Ngemplak, Kabupaten Boyolali',
                'latitude' => -7.519067,
                'longitude' => 110.751659,
                'accepted_materials' => ['Plastik', 'Kardus', 'Kertas', 'Kaca'],
            ],
            // Beberapa data Jakarta sebagai tambahan jika user mengetes jarak jauh
            [
                'name' => 'Bank Sampah Induk Jakarta Selatan',
                'address' => 'Jl. Mampang Prapatan, Jakarta Selatan',
                'latitude' => -6.2514,
                'longitude' => 106.8286,
                'accepted_materials' => ['Plastik', 'Kertas', 'Kardus', 'Kaca'],
            ],
        ];

        foreach ($centers as $center) {
            \App\Models\RecyclingCenter::create($center);
        }
    }
}
