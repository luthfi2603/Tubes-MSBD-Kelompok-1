<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('karya_tulis', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('judul', 500);
            $table->text('abstrak');
            $table->string('bidang_ilmu');
            $table->foreign('bidang_ilmu')->references('jenis_bidang_ilmu')->on('bidang_ilmus')->onDelete('restrict')->onUpdate('cascade');
            $table->string('url_file');
            $table->string('jenis');
            $table->foreign('jenis')->references('jenis_tulisan')->on('jenis_tulisans')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('view');
            $table->char('tahun', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('karya_tulis');
    }
};