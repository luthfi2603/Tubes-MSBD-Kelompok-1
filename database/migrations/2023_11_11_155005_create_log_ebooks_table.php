<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('log_ebooks', function (Blueprint $table) {
            $table->string('judul', 500);
            $table->string('penulis');
            $table->string('url_file');
            $table->char('tahun_terbit', 4);
            $table->string('diupload_oleh');
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_ebooks');
    }
};
