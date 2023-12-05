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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul', 500);
            $table->string('penulis');
            $table->string('url_file');
            $table->char('tahun_terbit', 4);
            $table->integer('view');
            $table->string('diupload_oleh');
        });
    
        DB::unprepared('
            CREATE TRIGGER log_ebooks_insert AFTER INSERT ON `ebooks` FOR EACH ROW
            BEGIN
                INSERT INTO log_ebooks VALUES (NEW.judul, NEW.penulis, NEW.url_file, NEW.tahun_terbit, NEW.diupload_oleh, "INSERT", CURRENT_TIMESTAMP());
            END
        ');

        DB::unprepared('
            CREATE TRIGGER log_ebooks_update AFTER UPDATE ON `ebooks` FOR EACH ROW
            BEGIN
                DECLARE judulT VARCHAR(500);
                DECLARE penulisT VARCHAR(255);
                DECLARE urlFileT VARCHAR(255);
                DECLARE tahunT CHAR(4);
                DECLARE diUploadOlehT VARCHAR(255);

                SET judulT = OLD.judul;
                SET penulisT = OLD.penulis;
                SET urlFileT = OLD.url_file;
                SET tahunT = OLD.tahun_terbit;
                SET diUploadOlehT = OLD.diupload_oleh;
            
                IF(NEW.judul <> OLD.judul) THEN
                    SET judulT = NEW.judul;
                END IF;
                IF(NEW.penulis <> OLD.penulis) THEN
                    SET penulisT = NEW.penulis;
                END IF;
                IF(NEW.url_file <> OLD.url_file) THEN
                    SET urlFileT = NEW.url_file;
                END IF;
                IF(NEW.tahun_terbit <> OLD.tahun_terbit) THEN
                    SET tahunT = NEW.tahun_terbit;
                END IF;
                IF(NEW.diupload_oleh <> OLD.diupload_oleh) THEN
                    SET diUploadOlehT = NEW.diupload_oleh;
                END IF;

                IF(NEW.view = OLD.view) THEN
                    INSERT INTO log_ebooks VALUES (judulT, penulisT, urlFileT, tahunT, diUploadOlehT, "UPDATE", NOW());
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER log_ebooks_delete AFTER DELETE ON `ebooks` FOR EACH ROW
            BEGIN
                INSERT INTO log_ebooks VALUES (OLD.judul, OLD.penulis, OLD.url_file, OLD.tahun_terbit, OLD.diupload_oleh, "DELETE", CURRENT_TIMESTAMP());
            END
        ');

    /**
     * Reverse the migrations.
     */
    }

    public function down(): void {
        Schema::dropIfExists('ebooks');
    }
};