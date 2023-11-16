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
            $table->increments('id');
            $table->string('judul', 500);
            $table->text('abstrak');
            $table->string('bidang_ilmu');
            $table->foreign('bidang_ilmu')->references('jenis_bidang_ilmu')->on('bidang_ilmus')->onDelete('restrict')->onUpdate('cascade');
            $table->string('url_file');
            $table->string('jenis');
            $table->foreign('jenis')->references('jenis_tulisan')->on('jenis_tulisans')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('view');
            $table->char('tahun', 4);
            $table->string('diupload_oleh');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_insert AFTER INSERT ON `karya_tulis` FOR EACH ROW
            BEGIN
                INSERT INTO log_karya_tulis VALUES (NEW.id, NEW.judul, NEW.abstrak, NEW.bidang_ilmu, NEW.url_view, NEW.tahun, NEW.diupload_oleh, "INSERT", NULL);
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_update AFTER UPDATE ON `karya_tulis` FOR EACH ROW
            BEGIN
                INSERT INTO log_karya_tulis VALUES (NEW.id, NEW.judul, NEW.abstrak, NEW.bidang_ilmu, NEW.url_view, NEW.tahun, NEW.diupload_oleh, "UPDATE", NULL);
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_delete AFTER DELETE ON `karya_tulis` FOR EACH ROW
            BEGIN
                INSERT INTO log_karya_tulis VALUES (OLD.id, OLD.judul, OLD.abstrak, OLD.bidang_ilmu, OLD.url_view, OLD.tahun, OLD.diupload_oleh, "DELETE", NULL);
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