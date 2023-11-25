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
            $table->char('kode_prodi', 2);
            $table->string('nama_prodi');
            $table->char('jenjang', 2);
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_prodis');
    }
};
