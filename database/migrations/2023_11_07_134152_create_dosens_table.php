<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('dosens', function (Blueprint $table) {
            $table->char('nidn', 10)->primary();
            $table->char('nip', 18);
            $table->string('nama');
            $table->char('kode_dosen', 3);
            $table->enum('jenis_kelamin', ['P','L']);
            $table->enum('status', ['aktif','tidak_aktif']);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->char('kode_prodi', 2);
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('dosens');
    }
};