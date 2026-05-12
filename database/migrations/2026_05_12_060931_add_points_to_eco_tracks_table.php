<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('eco_tracks', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel users (untuk fitur login)
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->string('item_name');
        $table->string('qr_code')->unique();
        $table->string('status');
        // Kolom untuk perhitungan poin
        $table->integer('points')->default(0);
        $table->decimal('weight', 8, 2)->default(0);
        $table->timestamps();
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