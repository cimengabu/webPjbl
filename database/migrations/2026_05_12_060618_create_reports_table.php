<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// NOTE: Migration ini duplikat dari 2026_05_11_041755_create_reports_table.php
// Dibiarkan kosong agar tidak menyebabkan error "Table already exists"
return new class extends Migration
{
    public function up(): void
    {
        // Tabel reports sudah dibuat di migration sebelumnya (2026_05_11_041755)
        // Migration ini sengaja dikosongkan untuk menghindari duplikasi
    }

    public function down(): void
    {
        // No-op
    }
};
