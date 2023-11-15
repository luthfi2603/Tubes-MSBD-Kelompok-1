<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('log_dosens', function (Blueprint $table) {
            $table->char('nidn', 10)->primary();
            $table->char('nip', 18);
            $table->string('nama');
            $table->char('kode_dosen', 3);
            $table->enum('jenis_kelamin', ['P','L']);
            $table->string('foto');
            $table->integer('user_id');
            $table->char('kode_prodi', 2);
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_dosens');
    }
};
