<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('log_prodis', function (Blueprint $table) {
            $table->char('kode_prodi', 2)->primary();
            $table->string('nama_prodi');
            $table->char('jenjang', 2);
            $table->enum('action', ['insert','update', 'delete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_prodis');
    }
};
