<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EcoTrack;
use App\Models\Pickup;
use App\Models\Withdraw;
use App\Models\Report;
use App\Models\RecyclingCenter;
use App\Models\Article;
use App\Models\Update;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@ecotrack.id'],
            [
                'name'         => 'Admin EcoTrack',
                'password'     => Hash::make('password'),
                'is_admin'     => true,
                'total_points' => 0,
            ]
        );

        // 2. Regular User
        $user = User::firstOrCreate(
            ['email' => 'user@ecotrack.id'],
            [
                'name'         => 'Budi Santoso',
                'password'     => Hash::make('password'),
                'is_admin'     => false,
                'total_points' => 3500,
            ]
        );

        // 3. Dummy EcoTrack Deposits for regular user
        $deposits = [
            ['item_name' => 'Botol Plastik PET', 'qr_code' => 'QR-ECO001AAA', 'weight' => 2.5,  'points' => 7500,  'status' => 'AI Optimized'],
            ['item_name' => 'Kardus Bekas',       'qr_code' => 'QR-ECO002BBB', 'weight' => 5.0,  'points' => 15000, 'status' => 'Completed'],
            ['item_name' => 'Kaleng Aluminium',   'qr_code' => 'QR-ECO003CCC', 'weight' => 1.8,  'points' => 5400,  'status' => 'AI Optimized'],
            ['item_name' => 'Koran & Majalah',    'qr_code' => 'QR-ECO004DDD', 'weight' => 3.2,  'points' => 9600,  'status' => 'Verified'],
            ['item_name' => 'Besi Bekas',         'qr_code' => 'QR-ECO005EEE', 'weight' => 4.0,  'points' => 12000, 'status' => 'Completed'],
        ];

        foreach ($deposits as $deposit) {
            EcoTrack::firstOrCreate(
                ['qr_code' => $deposit['qr_code']],
                array_merge($deposit, ['user_id' => $user->id])
            );
        }

        // 4. Dummy Pickups for regular user
        $pickups = [
            ['address' => 'Jl. Sudirman No. 12, Jakarta Pusat',    'weight' => 10.5, 'pickup_date' => '2026-05-15', 'status' => 'Completed'],
            ['address' => 'Jl. Gatot Subroto No. 45, Jakarta Sel', 'weight' => 8.0,  'pickup_date' => '2026-05-20', 'status' => 'Scheduled'],
            ['address' => 'Jl. Kebon Jeruk No. 7, Jakarta Barat',  'weight' => 5.5,  'pickup_date' => '2026-05-25', 'status' => 'Pending'],
        ];

        foreach ($pickups as $pickup) {
            Pickup::create(array_merge($pickup, ['user_id' => $user->id]));
        }

        // 5. Dummy Withdrawals for regular user
        $withdrawals = [
            ['method' => 'Bank Transfer', 'amount' => 5000, 'status' => 'Completed'],
            ['method' => 'E-Wallet',      'amount' => 2000, 'status' => 'Pending'],
        ];

        foreach ($withdrawals as $withdrawal) {
            Withdraw::create(array_merge($withdrawal, ['user_id' => $user->id]));
        }

        // 6. Dummy Reports (using user name as per schema)
        $reports = [
            [
                'user_name'   => $user->name,
                'photo'       => 'https://placehold.co/600x400/1a1a2e/10b981?text=Report+1',
                'description' => 'Tong sampah di depan kantor rusak dan tidak tertutup. Sampah berserakan.',
                'location'    => 'Bank Sampah Induk Kecamatan Setiabudi, Jakarta Selatan',
                'status'      => 'process',
            ],
            [
                'user_name'   => $user->name,
                'photo'       => 'https://placehold.co/600x400/1a1a2e/10b981?text=Report+2',
                'description' => 'Fasilitas pemilahan sampah di lokasi ini sudah tidak berfungsi dengan baik.',
                'location'    => 'Bank Sampah Bersatu, Jl. Mampang Prapatan',
                'status'      => 'pending',
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }

        // 7. Recycling Centers (Peta Bank Sampah)
        $centers = [
            [
                'name'               => 'Bank Sampah Induk Jakarta Selatan',
                'address'            => 'Jl. Prapanca Raya No. 9, Kebayoran Baru, Jakarta Selatan',
                'latitude'           => -6.2418,
                'longitude'          => 106.7998,
                'accepted_materials' => ['Plastik', 'Kertas', 'Logam', 'Kaca'],
            ],
            [
                'name'               => 'Bank Sampah Melati Bersih',
                'address'            => 'Jl. Cempaka Putih Raya No. 18, Jakarta Pusat',
                'latitude'           => -6.1754,
                'longitude'          => 106.8647,
                'accepted_materials' => ['Plastik PET', 'Kardus', 'Kertas Koran', 'Aluminium'],
            ],
            [
                'name'               => 'Bank Sampah Bersatu Mampang',
                'address'            => 'Jl. Mampang Prapatan Raya No. 32, Jakarta Selatan',
                'latitude'           => -6.2450,
                'longitude'          => 106.8200,
                'accepted_materials' => ['Plastik', 'Besi', 'Tembaga', 'Elektronik'],
            ],
            [
                'name'               => 'Bank Sampah Hijau Berseri',
                'address'            => 'Jl. Kebon Jeruk Raya No. 5, Jakarta Barat',
                'latitude'           => -6.1983,
                'longitude'          => 106.7637,
                'accepted_materials' => ['Kertas', 'Plastik HDPE', 'Kaca Botol'],
            ],
            [
                'name'               => 'Bank Sampah Lestari Utama',
                'address'            => 'Jl. Pegangsaan Dua No. 8, Kelapa Gading, Jakarta Utara',
                'latitude'           => -6.1466,
                'longitude'          => 106.9091,
                'accepted_materials' => ['Logam', 'Plastik', 'Kertas', 'Kardus'],
            ],
            [
                'name'               => 'Bank Sampah Sinar Harapan',
                'address'            => 'Jl. Condet Raya No. 21, Kramat Jati, Jakarta Timur',
                'latitude'           => -6.2742,
                'longitude'          => 106.8713,
                'accepted_materials' => ['Plastik', 'Kertas', 'Kaca', 'Baterai Bekas'],
            ],
        ];

        foreach ($centers as $center) {
            RecyclingCenter::firstOrCreate(
                ['name' => $center['name']],
                $center
            );
        }

        // 8. Edu-Articles
        $articles = [
            [
                'title'   => 'Mengapa Daur Ulang Sampah Plastik Sangat Penting untuk Indonesia?',
                'content' => "Indonesia adalah salah satu negara penyumbang sampah plastik terbesar di dunia. Setiap tahunnya, jutaan ton plastik berakhir di lautan dan tempat pembuangan akhir, merusak ekosistem dan mengancam kesehatan manusia.\n\nDaur ulang plastik bukan hanya soal menjaga kebersihan lingkungan. Ini juga tentang menciptakan ekonomi sirkular yang berkelanjutan. Ketika plastik didaur ulang, ia bisa berubah menjadi bahan baku untuk produk baru, mengurangi kebutuhan akan plastik virgin yang diproduksi dari minyak bumi.\n\nEcoTrack hadir untuk memudahkan Anda berkontribusi dalam gerakan daur ulang ini. Dengan sistem poin yang kami miliki, setiap kilogram sampah yang Anda kumpulkan bernilai nyata.",
                'image'   => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=800&auto=format&fit=crop',
                'status'  => 'Published',
            ],
            [
                'title'   => 'Cara Memilah Sampah yang Benar di Rumah: Panduan Lengkap',
                'content' => "Memilah sampah adalah langkah pertama dan paling penting dalam proses daur ulang. Namun, banyak orang yang belum tahu cara melakukannya dengan benar.\n\nBerikut adalah panduan praktis memilah sampah di rumah:\n\n1. SAMPAH ORGANIK: Sisa makanan, dedaunan, dan bahan alami lainnya. Bisa dijadikan kompos.\n\n2. SAMPAH ANORGANIK DAUR ULANG: Plastik, kertas, kaca, dan logam. Inilah yang bisa dibawa ke bank sampah.\n\n3. SAMPAH B3 (Bahan Berbahaya & Beracun): Baterai, lampu, obat-obatan kedaluwarsa. Perlu penanganan khusus.\n\n4. SAMPAH RESIDU: Sampah yang tidak bisa didaur ulang, seperti styrofoam dan plastik berlapis.\n\nDengan memilah sampah dari rumah, Anda membantu proses daur ulang menjadi lebih efisien dan efektif.",
                'image'   => 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=800&auto=format&fit=crop',
                'status'  => 'Published',
            ],
            [
                'title'   => 'EcoPoints: Ubah Sampahmu Menjadi Penghasilan Nyata',
                'content' => "Program EcoPoints dari EcoTrack adalah cara revolusioner untuk mengubah kebiasaan daur ulang menjadi manfaat finansial yang nyata. Sistem ini dirancang untuk memberi penghargaan kepada individu yang aktif berkontribusi dalam pengurangan sampah.\n\nBagaimana cara kerjanya?\n\nSetiap kali Anda menyetorkan sampah daur ulang ke bank sampah melalui platform EcoTrack, Anda akan mendapatkan poin berdasarkan jenis dan berat sampah yang dikumpulkan. Semakin berat dan semakin bernilai jenis sampahnya, semakin banyak poin yang Anda dapatkan.\n\nPoin yang terkumpul kemudian dapat ditukarkan dengan uang tunai melalui transfer bank atau e-wallet pilihan Anda. Program ini telah membantu ribuan keluarga Indonesia mendapatkan penghasilan tambahan sambil menjaga lingkungan.",
                'image'   => 'https://images.unsplash.com/photo-1542601906897-ecd57a1a3c88?w=800&auto=format&fit=crop',
                'status'  => 'Published',
            ],
        ];

        foreach ($articles as $article) {
            Article::firstOrCreate(
                ['title' => $article['title']],
                $article
            );
        }

        // 9. Update Version Data (untuk banner versi di halaman utama)
        Update::firstOrCreate(
            ['version_name' => 'V3.0'],
            [
                'version_name'  => 'V3.0',
                'changelog_text' => 'AI Waste Scanner V2, Smart Pickup, Eco-Points Withdraw System',
                'is_ai_powered' => true,
            ]
        );

        $this->command->info('✅ Seeder berhasil! Admin: admin@ecotrack.id | User: user@ecotrack.id | Password: password');
    }
}
