<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('dosens', function (Blueprint $table) {
            $table->char('nidn', 10)->primary();
            $table->char('nip', 18);
            $table->string('nama');
            $table->char('kode_dosen', 3);
            $table->enum('jenis_kelamin', ['P','L']);
            $table->string('foto');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->char('kode_prodi', 2);
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER log_dosens_insert AFTER INSERT ON `dosens` FOR EACH ROW
            BEGIN
                INSERT INTO log_dosens VALUES (NEW.nidn, NEW.nip, NEW.nama, NEW.kode_dosen, NEW.jenis_kelamin, NEW.foto, NEW.user_id, NEW.kode_prodi, "INSERT", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_dosens_update AFTER UPDATE ON `dosens` FOR EACH ROW
            BEGIN
                INSERT INTO log_dosens VALUES (NEW.nidn, NEW.nip, NEW.nama, NEW.kode_dosen, NEW.jenis_kelamin, NEW.foto, NEW.user_id, NEW.kode_prodi, "UPDATE", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_dosens_delete AFTER DELETE ON `dosens` FOR EACH ROW
            BEGIN
                INSERT INTO log_dosens VALUES (OLD.nidn, OLD.nip, OLD.nama, OLD.kode_dosen, OLD.jenis_kelamin, OLD.foto, OLD.user_id, OLD.kode_prodi, "DELETE", NULL);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('dosens');
    }
};