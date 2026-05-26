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

### 🛡️ Fitur & Hak Akses Administrator
Admin menggunakan gerbang _login_ dan tampilan *Dashboard* yang sama dengan pengguna publik (menyatu dengan mulus), namun sistem secara otomatis memberikan hak akses penuh:
- **Visibilitas Data Global:** Melihat dan mengelola seluruh riwayat *deposit*, *request* penjemputan, dan laporan dari semua pengguna di *Dashboard*.
- **Verifikasi Transaksi:** Menyetujui atau menolak *request* Penjemputan, Tarik Poin, dan Laporan.
- **Manajemen Pengguna (CRUD):** Mengelola data seluruh pengguna terdaftar dan mengawasi aktivitas mereka.
- **Manajemen Artikel (CRUD):** Mempublikasikan, mengedit, atau menghapus konten edukasi di *frontend*.
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

Sistem sudah memiliki Data Seeder bawaan. Anda dapat _login_ melalui halaman biasa (`http://localhost:8000/login`) menggunakan kredensial berikut:

- **Admin:** `admin@ecotrack.id` | Password: `password`
- **Member Biasa:** `user@ecotrack.id` | Password: `password`

*(Akun Admin dapat mengakses fitur CRUD tambahan melalui menu "Manajemen Data" di bilah navigasi atas).*

---

## 📸 Tangkapan Layar (Screenshots)

### 🔐 Halaman Autentikasi
<div align="center">
  <img src="public/screenshoot/login.png" alt="Login" width="45%" />
  <img src="public/screenshoot/register.png" alt="Register" width="45%" />
</div>

### 🏠 Beranda (Landing Page)
<div align="center">
  <img src="public/screenshoot/127.0.0.1_8000_.png" alt="Landing Page" width="80%" />
  <br><br>
  <img src="public/screenshoot/127.0.0.1_8000_%20(1).png" alt="Landing Page Section 1" width="45%" />
  <img src="public/screenshoot/127.0.0.1_8000_%20(2).png" alt="Landing Page Section 2" width="45%" />
</div>

### 📊 Dashboard Pengguna
<div align="center">
  <img src="public/screenshoot/127.0.0.1_8000_dashboard.png" alt="Dashboard Full" width="80%" />
  <br><br>
  <img src="public/screenshoot/dashboard.png" alt="Dashboard 1" width="45%" />
  <img src="public/screenshoot/dashboard2.png" alt="Dashboard 2" width="45%" />
  <br><br>
  <img src="public/screenshoot/dashboard3.png" alt="Dashboard 3" width="45%" />
  <img src="public/screenshoot/dashboard4.png" alt="Dashboard 4" width="45%" />
</div>

### 🌍 Fitur Utama & Profil
<div align="center">
  <img src="public/screenshoot/peta.png" alt="Peta Bank Sampah" width="45%" />
  <img src="public/screenshoot/127.0.0.1_8000_profile.png" alt="Profil Pengguna" width="45%" />
  <br><br>
  <img src="public/screenshoot/laporan%20.png" alt="Laporan Lingkungan" width="45%" />
  <img src="public/screenshoot/tarik%20saldo.png" alt="Tarik Saldo" width="45%" />
</div>

<br>

---
<div align="center">
  <p>Dibuat dengan ❤️ untuk pelestarian lingkungan.</p>
</div>

