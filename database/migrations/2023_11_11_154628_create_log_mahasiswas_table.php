<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('log_mahasiswas', function (Blueprint $table) {
            $table->char('nim', 9);
            $table->string('nama');
            $table->char('angkatan', 4);
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->string('foto');
            $table->enum('status', ['aktif','tidak_aktif', 'lulus']);
            $table->unsignedInteger('user_id');
            $table->char('kode_prodi', 2);
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_mahasiswas');
    }
};
