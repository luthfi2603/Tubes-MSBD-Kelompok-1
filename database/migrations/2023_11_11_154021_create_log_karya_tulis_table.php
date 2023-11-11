<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('log_karya_tulis', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('judul', 500);
            $table->text('abstrak');
            $table->string('bidang_ilmu');
            $table->string('url_file');
            $table->string('jenis');
            $table->integer('view');
            $table->char('tahun', 4);
            $table->string('diupload_oleh');
            $table->enum('action', ['insert','update', 'delete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_karya_tulis');
    }
};
