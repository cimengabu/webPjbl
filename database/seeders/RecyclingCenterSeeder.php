<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecyclingCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centers = [
            [
                'name' => 'Bank Sampah Induk Jakarta Selatan',
                'address' => 'Jl. Mampang Prapatan, Jakarta Selatan',
                'latitude' => -6.2514,
                'longitude' => 106.8286,
                'accepted_materials' => json_encode(['Plastik', 'Kertas', 'Kardus', 'Kaca']),
            ],
            [
                'name' => 'Pusat Daur Ulang Kemayoran',
                'address' => 'Kawasan Kemayoran, Jakarta Pusat',
                'latitude' => -6.1624,
                'longitude' => 106.8521,
                'accepted_materials' => json_encode(['Logam', 'Elektronik (e-waste)', 'Baterai']),
            ],
            [
                'name' => 'Bank Sampah Berseri Bintaro',
                'address' => 'Bintaro Jaya Sektor 7, Tangerang Selatan',
                'latitude' => -6.2831,
                'longitude' => 106.7214,
                'accepted_materials' => json_encode(['Plastik', 'Minyak Jelantah', 'Kertas']),
            ],
            [
                'name' => 'E-Waste Dropzone Monas',
                'address' => 'Area Parkir IRTI Monas, Jakarta Pusat',
                'latitude' => -6.1754,
                'longitude' => 106.8272,
                'accepted_materials' => json_encode(['Elektronik (e-waste)', 'Kabel', 'Lampu']),
            ],
        ];

        foreach ($centers as $center) {
            \App\Models\RecyclingCenter::create($center);
        }
    }
}
