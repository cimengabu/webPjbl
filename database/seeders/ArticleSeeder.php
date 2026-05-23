<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'Teknologi AI dalam Daur Ulang',
            'content' => 'Kecerdasan Buatan (AI) kini menjadi kunci utama dalam memilah sampah dengan presisi tingkat tinggi. Dengan sensor optik canggih...',
            'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=800&auto=format&fit=crop',
            'status' => 'Published'
        ]);

        Article::create([
            'title' => 'Manfaat Ekonomi Circular',
            'content' => 'Ekonomi sirkular bukan hanya tentang lingkungan, tapi juga penciptaan nilai ekonomi baru dari barang yang sebelumnya dibuang...',
            'image' => 'https://images.unsplash.com/photo-1604187351574-c75ca79f5807?q=80&w=800&auto=format&fit=crop',
            'status' => 'Published'
        ]);

        Article::create([
            'title' => 'Panduan Kompos Rumahan',
            'content' => 'Membuat kompos di rumah sangat mudah. Mulailah dengan memisahkan sampah organik sisa makanan Anda setiap hari...',
            'image' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=800&auto=format&fit=crop',
            'status' => 'Published'
        ]);
    }
}
