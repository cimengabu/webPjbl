<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('updates', function (Blueprint $table) {
        $table->id();
        $table->string('version_name'); // Pastikan baris ini ada
        $table->text('changelog_text'); // Pastikan baris ini ada
        $table->boolean('is_ai_powered')->default(true); // Pastikan baris ini ada
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('updates');
    }
};
