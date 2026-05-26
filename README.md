<div align="center">
  <br />
  <p>
    <a href="https://github.com/cimengabu/webPjbl"><img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11" /></a>
    <a href="https://github.com/cimengabu/webPjbl"><img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" /></a>
    <a href="https://github.com/cimengabu/webPjbl"><img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+" /></a>
  </p>
  
  # 🌿 EcoTrack Indonesia

  **Platform Manajemen Bank Sampah & Pelestarian Lingkungan Berbasis Web**
</div>

---

## 📖 Deskripsi Proyek
**EcoTrack** adalah aplikasi inovatif yang dirancang untuk mendorong masyarakat agar lebih peduli terhadap lingkungan melalui sistem manajemen bank sampah yang terintegrasi. Platform ini memberikan apresiasi (berupa *Eco-Points*) kepada pengguna setiap kali mereka melakukan aksi pelestarian, seperti mendepositkan sampah daur ulang atau melaporkan masalah lingkungan. Poin yang terkumpul dapat ditukarkan (*withdraw*) menjadi saldo *e-wallet*.

Proyek ini dibangun menggunakan **Laravel 11** dan **Tailwind CSS**, dengan antarmuka (*UI*) yang dirancang sangat modern, interaktif, dan premium.

## ✨ Fitur Utama

### 👤 Fitur Pengguna (Masyarakat)
- **Dashboard Personal:** Melacak aktivitas pelestarian, total poin (PTS), dan *streak* lingkungan secara *real-time*.
- **Setor Sampah (Deposit):** Menyetor sampah ke bank sampah terdekat untuk mendapatkan poin.
- **Peta Lokasi Bank Sampah:** Menemukan lokasi bank sampah terdekat menggunakan peta interaktif (*Leaflet.js*).
- **Request Penjemputan (Pickup):** Meminta agen menjemput sampah langsung dari rumah.
- **Tarik Poin (Withdraw):** Menukarkan *Eco-Points* dengan saldo GoPay, OVO, atau DANA.
- **Laporan Lingkungan:** Melaporkan kerusakan fasilitas, tumpukan sampah liar, atau polusi di sekitar untuk mendapatkan poin tambahan.
- **Artikel Edukasi:** Membaca artikel terkait pelestarian lingkungan untuk menambah wawasan.

### 🛡️ Fitur Administrator (Portal Eksklusif)
Admin memiliki portal akses mandiri (terpisah dari *frontend* publik) dengan keamanan ekstra dan tema *Crimson Dark* yang elegan.
- **Dashboard Statistik:** Ringkasan total sampah terkumpul, jumlah *deposit*, dan *request* yang pending.
- **Verifikasi Transaksi:** Menyetujui atau menolak *request* Penjemputan, Tarik Poin, dan Laporan.
- **Manajemen Pengguna (CRUD):** Mengelola data seluruh pengguna terdaftar dan jumlah poin mereka.
- **Manajemen Artikel (CRUD):** Mempublikasikan atau menyimpan *draft* konten edukasi ke *frontend*.
- **Manajemen Bank Sampah (CRUD):** Menambah, mengubah, atau menghapus titik koordinat bank sampah dari sistem peta.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 11.x (PHP)
* **Frontend:** Blade Templating, Tailwind CSS (Vanilla + PostCSS)
* **Database:** MySQL / SQLite
* **Map Engine:** Leaflet.js & OpenStreetMap
* **Ikon:** Heroicons

---

## ⚙️ Persyaratan Sistem (*Prerequisites*)

Pastikan Anda telah menginstal *software* berikut di perangkat Anda:
- **PHP** >= 8.2
- **Composer** (untuk dependensi backend)
- **Node.js** & **NPM** (untuk *build* frontend)
- **MySQL / MariaDB** (atau SQLite)
- **Git**

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan EcoTrack di lokal Anda:

1. **Clone repositori ini**
   ```bash
   git clone https://github.com/cimengabu/webPjbl.git
   cd webPjbl
   ```

2. **Instal dependensi PHP & Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Salin file environment & konfigurasi Database**
   ```bash
   cp .env.example .env
   ```
   > **Note:** Buka file `.env` yang baru dibuat dan sesuaikan konfigurasi database Anda (misal `DB_DATABASE=ecotrack`, username, password).

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

6. **Buat Symlink untuk Storage (Wajib untuk gambar artikel/profil)**
   ```bash
   php artisan storage:link
   ```

7. **Compile aset Frontend (Tailwind CSS)**
   ```bash
   npm run build
   # atau gunakan 'npm run dev' untuk mode development
   ```

8. **Jalankan Server Lokal Laravel**
   ```bash
   php artisan serve
   ```
   Aplikasi sekarang dapat diakses melalui `http://localhost:8000`.

---

## 🔐 Akun Akses (Untuk Testing)

Untuk masuk ke mode Admin, kunjungi URL berikut secara spesifik karena portal Admin tersembunyi dari navigasi publik:
👉 **URL Admin:** `http://localhost:8000/admin/login`

*(Gunakan akun admin yang telah Anda atur di database atau registrasikan secara manual via `tinker` dan set `is_admin = 1`)*.

---

## 📸 Tangkapan Layar (Screenshots)

**(Anda dapat menambahkan screenshot aplikasi di sini nanti)*

<br>

---
<div align="center">
  <p>Dibuat dengan ❤️ untuk pelestarian lingkungan.</p>
</div>
