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
        Schema::create('karya_tulis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul', 500);
            $table->text('abstrak');
            $table->string('bidang_ilmu');
            $table->foreign('bidang_ilmu')->references('jenis_bidang_ilmu')->on('bidang_ilmus')->onDelete('restrict')->onUpdate('cascade');
            $table->string('url_file');
            $table->string('jenis');
            $table->foreign('jenis')->references('jenis_tulisan')->on('jenis_tulisans')->onDelete('restrict')->onUpdate('cascade');
            $table->char('tahun', 4);
            $table->integer('view');
            $table->unsignedInteger('diupload_oleh');
            $table->foreign('diupload_oleh')->references('id')->on('admins')->onDelete('restrict')->onUpdate('cascade');
        });

        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_insert AFTER INSERT ON `karya_tulis` FOR EACH ROW
            BEGIN
                INSERT INTO log_karya_tulis VALUES (NEW.judul, NEW.abstrak, NEW.bidang_ilmu, NEW.url_file, NEW.jenis, NEW.tahun, NEW.diupload_oleh, "INSERT", CURRENT_TIMESTAMP());
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_update AFTER UPDATE ON `karya_tulis` FOR EACH ROW
            BEGIN
                INSERT INTO log_karya_tulis VALUES (NEW.judul, NEW.abstrak, NEW.bidang_ilmu, NEW.url_file, NEW.jenis, NEW.tahun, NEW.diupload_oleh, "UPDATE", CURRENT_TIMESTAMP());
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_delete AFTER DELETE ON `karya_tulis` FOR EACH ROW
            BEGIN
                INSERT INTO log_karya_tulis VALUES (OLD.judul, OLD.abstrak, OLD.bidang_ilmu, OLD.url_file, OLD.jenis, OLD.tahun, OLD.diupload_oleh, "DELETE", CURRENT_TIMESTAMP());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('karya_tulis');
    }
};