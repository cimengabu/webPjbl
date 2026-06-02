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

## 🔄 Alur Kerja Aplikasi (Flowchart)

### 1. Alur Utama Pengguna

```mermaid
flowchart TD
    START([Pengunjung]) --> LANDING[Landing Page - EcoTrack]
    LANDING --> PUBLIC_MENU{Menu Publik}
    PUBLIC_MENU --> PETA[Peta Bank Sampah - Leaflet.js]
    PUBLIC_MENU --> ARTIKEL_LIST[Artikel Edukasi]
    PUBLIC_MENU --> AUTH{Login / Register}

    PETA --> NEARBY[Cari Bank Sampah Terdekat - Haversine]
    ARTIKEL_LIST --> ARTIKEL_DETAIL[Baca Detail Artikel]
    KOMUNITAS --> SEARCH[Cari Nama User]
    SEARCH --> PROFIL_USER[Lihat Profil & Riwayat User]

    AUTH -->|Register| REG[Isi Nama, Email, Password]
    REG --> LOGIN
    AUTH -->|Login| LOGIN[Masukkan Email & Password]

    DASHBOARD --> D_DEPOSIT[Setor Sampah - Deposit]
    DASHBOARD --> D_PICKUP[Request Penjemputan]
    DASHBOARD --> D_REPORT[Lapor Masalah Lingkungan]
    DASHBOARD --> D_WITHDRAW["Tarik Poin (Withdraw)"]
    DASHBOARD --> D_PROFILE[Edit Profil & Foto]
```

### 2. Alur Deposit, Poin & Withdraw

```mermaid
flowchart TD
    DEP_START([User Login]) --> DEP_FORM[Isi Form Deposit]
    DEP_FORM --> DEP_INPUT[Input: Jenis Sampah, QR Code, Berat]
    DEP_INPUT --> DEP_CALC["Hitung Poin = Berat x Harga/Kg"]
    DEP_CALC --> DEP_SAVE[Simpan ke Database - Status: AI Optimized]
    DEP_SAVE --> DEP_POINTS[Poin Ditambahkan ke total_points User]
    DEP_POINTS --> DEP_DASHBOARD[Tampil di Dashboard & Profil User]

    PICKUP_START([User Login]) --> PICKUP_FORM[Isi Form Penjemputan]
    PICKUP_FORM --> PICKUP_INPUT[Input: Tanggal, Berat, Alamat]
    PICKUP_INPUT --> PICKUP_SAVE[Simpan ke Database - Status: Pending]
    PICKUP_SAVE --> PICKUP_WAIT["Menunggu Update Status Admin"]
    PICKUP_WAIT --> PICKUP_STATUS{Status Diubah Admin}
    PICKUP_STATUS --> PICKUP_SCHED[Scheduled]
    PICKUP_STATUS --> PICKUP_DONE[Completed]
    PICKUP_STATUS --> PICKUP_CANCEL[Cancelled]

    WD_START([User Login]) --> WD_CHECK{Poin Cukup? - Min. 50}
    WD_CHECK -->|Tidak| WD_FAIL[Penarikan Gagal - Poin Tidak Cukup]
    WD_CHECK -->|Ya| WD_FORM[Isi Form Withdraw]
    WD_FORM --> WD_INPUT["Input: Metode (GoPay/OVO/DANA), Nominal, No. Rekening, Nama"]
    WD_INPUT --> WD_DEDUCT[Poin Dikurangi dari total_points]
    WD_DEDUCT --> WD_SAVE[Simpan ke Database - Status: Completed]
    WD_SAVE --> WD_DONE([Dana Terkirim ke e-Wallet])

    RPT_START([User Login]) --> RPT_FORM[Isi Form Laporan]
    RPT_FORM --> RPT_INPUT[Input: Deskripsi, Lokasi, Upload Foto]
    RPT_INPUT --> RPT_SAVE[Simpan ke Database - Status: pending]
    RPT_SAVE --> RPT_WAIT["Menunggu Verifikasi Admin"]
    RPT_WAIT --> RPT_STATUS{Status Diubah Admin}
    RPT_STATUS --> RPT_PROC[process]
    RPT_STATUS --> RPT_RESOLVED[resolved]
```

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

