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
            $table->string('judul', 500);
            $table->text('abstrak');
            $table->string('bidang_ilmu');
            $table->string('url_file');
            $table->string('jenis');
            $table->char('tahun', 4);
            $table->string('diupload_oleh');
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu');
        });

        DB::unprepared('
            CREATE TRIGGER dont_delete_log_karya BEFORE DELETE ON `log_karya_tulis` FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Tidak dapat menghapus data log karya tulis";
            END
        ');
        DB::unprepared('
            CREATE TRIGGER dont_update_log_karya BEFORE UPDATE ON `log_karya_tulis` FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Tidak dapat mengubah data log karya tulis";
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_karya_tulis');
    }
};