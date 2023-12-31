<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->char('nim', 9)->primary();
            $table->string('nama');
            $table->char('angkatan', 4);
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->enum('status', ['aktif','tidak_aktif', 'lulus']);
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
        Schema::dropIfExists('mahasiswas');
    }
};