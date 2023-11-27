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
            $table->char('tahun_terbit', 4);
            $table->integer('view');
            $table->string('diupload_oleh');
        });
    
        DB::unprepared('
            CREATE TRIGGER log_ebooks_insert AFTER INSERT ON `ebooks` FOR EACH ROW
            BEGIN
                INSERT INTO log_ebooks VALUES (NEW.id, NEW.judul, NEW.penulis, NEW.url_file, NEW.tahun_terbit, NEW.diupload_oleh, "INSERT", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_ebooks_update AFTER UPDATE ON `ebooks` FOR EACH ROW
            BEGIN
                INSERT INTO log_ebooks VALUES (NEW.id, NEW.judul, NEW.penulis, NEW.url_file, NEW.tahun_terbit, NEW.diupload_oleh, "UPDATE", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_ebooks_delete AFTER DELETE ON `ebooks` FOR EACH ROW
            BEGIN
                INSERT INTO log_ebooks VALUES (OLD.id, OLD.judul, OLD.penulis, OLD.url_file, OLD.tahun_terbit, OLD.diupload_oleh, "DELETE", NULL);
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