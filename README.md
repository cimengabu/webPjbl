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

---

## 🔄 Alur Kerja Aplikasi (Flowchart)

### 1. Alur Navigasi Utama

```mermaid
flowchart TD
    A([Pengunjung Baru]) --> B[Landing Page EcoTrack]
    B --> C{Pilih Menu}

    C --> D[Peta Bank Sampah]
    C --> E[Artikel Edukasi]
    C --> F[Login / Register]

    D --> D1[Lihat Lokasi Bank Sampah di Peta]
    D1 --> D2[Cari Bank Sampah Terdekat]

    E --> E1[Baca Detail Artikel]

    F -->|Belum Punya Akun| G[Register - Isi Nama, Email, Password]
    G --> H[Login]
    F -->|Sudah Punya Akun| H[Login - Email dan Password]

    H --> I[Dashboard Pengguna]

    I --> J[Setor Sampah]
    I --> K[Request Penjemputan]
    I --> L[Lapor Masalah Lingkungan]
    I --> M["Tarik Poin (Withdraw)"]
    I --> N[Edit Profil dan Foto]
```

### 2. Alur Setor Sampah (Deposit)

```mermaid
flowchart TD
    A1([Mulai]) --> A2[Buka Form Deposit]
    A2 --> A3[Pilih Jenis Sampah]
    A3 --> A4[Masukkan QR Code Unik]
    A4 --> A5[Masukkan Berat Sampah dalam kg]
    A5 --> A6[Sistem Hitung Poin Otomatis - Berat x Harga per Kg]
    A6 --> A7[Data Tersimpan di Database]
    A7 --> A8[Poin Langsung Masuk ke Akun]
    A8 --> A9([Selesai - Lihat Poin di Dashboard])
```

### 3. Alur Request Penjemputan

```mermaid
flowchart TD
    B1([Mulai]) --> B2[Buka Form Penjemputan]
    B2 --> B3[Pilih Tanggal Penjemputan]
    B3 --> B4[Isi Estimasi Berat Sampah]
    B4 --> B5[Isi Alamat Penjemputan]
    B5 --> B6[Kirim Request]
    B6 --> B7[Status: Pending - Menunggu Konfirmasi]
    B7 --> B8([Selesai - Pantau Status di Dashboard])
```

### 4. Alur Laporan Masalah Lingkungan

```mermaid
flowchart TD
    C1([Mulai]) --> C2[Buka Form Laporan]
    C2 --> C3[Tulis Deskripsi Masalah]
    C3 --> C4[Isi Lokasi Kejadian]
    C4 --> C5[Upload Foto Bukti - JPG / PNG maks 2MB]
    C5 --> C6[Kirim Laporan]
    C6 --> C7[Status: Pending]
    C7 --> C8([Selesai - Pantau Status di Dashboard])
```

### 5. Alur Tarik Poin (Withdraw)

```mermaid
flowchart TD
    D1([Mulai]) --> D2[Buka Form Withdraw]
    D2 --> D3{Poin Mencukupi - Minimal 50?}
    D3 -->|Tidak| D4[Tampil Pesan Gagal - Poin Tidak Cukup]
    D4 --> D5([Selesai - Tambah Poin Dulu])
    D3 -->|Ya| D6[Pilih Metode: GoPay / OVO / DANA]
    D6 --> D7[Isi Jumlah Penarikan]
    D7 --> D8[Isi Nomor dan Nama Rekening]
    D8 --> D9[Poin Dipotong dari Akun]
    D9 --> D10[Transaksi Disimpan - Status: Completed]
    D10 --> D11([Selesai - Dana Terkirim ke e-Wallet])
```

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 11.x (PHP)
* **Frontend:** Blade Templating, Tailwind CSS (Vanilla + PostCSS)
* **Database:** MySQL / SQLite

**Database Schema**

| Table | Columns |
|-------|---------|
| `users` | `id` (bigIncrements), `name` (string), `email` (string, unique), `email_verified_at` (timestamp, nullable), `password` (string), `remember_token` (string, nullable), `is_admin` (boolean, default false), `profile_photo_path` (string, nullable), `total_points` (integer, default 0), `created_at`, `updated_at` |
| `password_reset_tokens` | `email` (string, primary), `token` (string), `created_at` (timestamp, nullable) |
| `sessions` | `id` (string, primary), `user_id` (foreignId, nullable), `ip_address` (string, 45, nullable), `user_agent` (text, nullable), `payload` (longText), `last_activity` (integer) |
| `recycling_centers` | `id` (bigIncrements), `name` (string), `address` (string), `latitude` (decimal), `longitude` (decimal), `accepted_materials` (json, nullable), `maps_url` (string, nullable), `created_at`, `updated_at` |
| `reports` | `id` (bigIncrements), `user_name` (string), `photo` (string), `description` (text), `location` (string), `status` (enum: `pending`, `process`, `resolved`, default `pending`), `created_at`, `updated_at` |
| `eco_activities` | `id` (bigIncrements), `user_id` (foreignId), `type` (enum: `deposit`, `pickup`, `withdraw`, `report`), `points` (integer), `description` (text, nullable), `created_at`, `updated_at` |
| `eco_tracks` | `id` (bigIncrements), `user_id` (foreignId), `activity_id` (foreignId), `points` (integer), `created_at`, `updated_at` |
| `withdraws` | `id` (bigIncrements), `user_id` (foreignId), `amount` (decimal), `status` (enum: `pending`, `approved`, `rejected`, default `pending`), `created_at`, `updated_at` |
| `pickups` | `id` (bigIncrements), `user_id` (foreignId), `center_id` (foreignId), `schedule_at` (datetime), `status` (enum: `requested`, `scheduled`, `completed`, `cancelled`, default `requested`), `created_at`, `updated_at` |
| `articles` | `id` (bigIncrements), `title` (string), `content` (longText), `image_path` (string, nullable), `author_id` (foreignId), `created_at`, `updated_at` |
| `updates` | `id` (bigIncrements), `title` (string), `content` (text), `image_path` (string, nullable), `created_at`, `updated_at` |

The `maps_url` column stores the Google Maps link for each recycling center, enabling direct navigation from the platform.

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
