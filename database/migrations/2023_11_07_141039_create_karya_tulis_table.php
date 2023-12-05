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
            $table->string('diupload_oleh');
        });

        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_insert AFTER INSERT ON `karya_tulis` FOR EACH ROW
            BEGIN
                INSERT INTO log_karya_tulis VALUES (NEW.judul, NEW.abstrak, NEW.bidang_ilmu, NEW.url_file, NEW.jenis, NEW.tahun, NEW.diupload_oleh, "INSERT", CURRENT_TIMESTAMP());
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_karya_tulis_update AFTER UPDATE ON karya_tulis FOR EACH ROW
            BEGIN
                DECLARE judulT VARCHAR(500);
                DECLARE bidangIlmuT VARCHAR(255);
                DECLARE abstrakT TEXT;
                DECLARE urlFileT VARCHAR(255);
                DECLARE jenisT VARCHAR(255);
                DECLARE tahunT CHAR(4);
                DECLARE diUploadOlehT VARCHAR(255);
                
                SET judulT = OLD.judul;
                SET bidangIlmuT = OLD.bidang_ilmu;
                SET abstrakT = OLD.abstrak;
                SET urlFileT = OLD.url_file;
                SET jenisT = OLD.jenis;
                SET tahunT = OLD.tahun;
                SET diUploadOlehT = OLD.diupload_oleh;
            
                IF(NEW.judul <> OLD.judul) THEN
                    SET judulT = NEW.judul;
                END IF;
                IF(NEW.bidang_ilmu <> OLD.bidang_ilmu) THEN
                    SET bidangIlmuT = NEW.bidang_ilmu;
                END IF;
                IF(NEW.abstrak <> OLD.abstrak) THEN
                    SET abstrakT = NEW.abstrak;
                END IF;
                IF(NEW.url_file <> OLD.url_file) THEN
                    SET urlFileT = NEW.url_file;
                END IF;
                IF(NEW.jenis <> OLD.jenis) THEN
                    SET jenisT = NEW.jenis;
                END IF;
                IF(NEW.tahun <> OLD.tahun) THEN
                    SET tahunT = NEW.tahun;
                END IF;
                IF(NEW.diupload_oleh <> OLD.diupload_oleh) THEN
                    SET diUploadOlehT = NEW.diupload_oleh;
                END IF;

                IF(NEW.view = OLD.view) THEN
                    INSERT INTO log_karya_tulis VALUES (judulT, abstrakT, bidangIlmuT, urlFileT, jenisT, tahunT, diUploadOlehT, "UPDATE", NOW());
                END IF;
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