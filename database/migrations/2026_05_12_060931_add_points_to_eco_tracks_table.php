<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom user_id, points, dan weight ke tabel eco_tracks yang sudah ada
     */
    public function up()
    {
        Schema::table('eco_tracks', function (Blueprint $table) {
            // Menghubungkan ke tabel users (untuk fitur login)
            if (!Schema::hasColumn('eco_tracks', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }
            // Kolom untuk perhitungan poin
            if (!Schema::hasColumn('eco_tracks', 'points')) {
                $table->integer('points')->default(0);
            }
            if (!Schema::hasColumn('eco_tracks', 'weight')) {
                $table->decimal('weight', 8, 2)->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('eco_tracks', function (Blueprint $table) {
            // Menghapus kembali kolom jika migration di-rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'points', 'weight']);
        });
    }
};