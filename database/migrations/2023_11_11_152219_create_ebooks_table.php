<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul', 500);
            $table->string('penulis');
            $table->string('url_file');
            $table->integer('view');
            $table->string('tgl_terbit');
            $table->string('diupload_oleh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ebooks');
    }
};