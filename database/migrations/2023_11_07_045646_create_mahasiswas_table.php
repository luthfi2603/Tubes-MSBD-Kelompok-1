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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->char('nim', 9)->primary();
            $table->string('nama');
            $table->char('angkatan', 4);
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->string('foto');
            $table->enum('status', ['Aktif','Tidak Aktif', 'Lulus']);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->char('kode_prodi', 2);
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER log_mahasiswas_insert AFTER INSERT ON `mahasiswas` FOR EACH ROW
            BEGIN
                INSERT INTO log_mahasiswas VALUES (NEW.nim, NEW.nama, NEW.angkatan, NEW.jenis_kelamin, NEW.foto, NEW.status, NEW.user_id, NEW.kode_prodi, "INSERT", NULL);
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_mahasiswas_update AFTER UPDATE ON `mahasiswas` FOR EACH ROW
            BEGIN
                INSERT INTO log_mahasiswas VALUES (NEW.nim, NEW.nama, NEW.angkatan, NEW.jenis_kelamin, NEW.foto, NEW.status, NEW.user_id, NEW.kode_prodi, "UPDATE", NULL);
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_mahasiswas_delete AFTER DELETE ON `mahasiswas` FOR EACH ROW
            BEGIN
                INSERT INTO log_mahasiswas VALUES (OLD.nim, OLD.nama, OLD.angkatan, OLD.jenis_kelamin, OLD.foto, OLD.status, OLD.user_id, OLD.kode_prodi, "DELETE", NULL);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('mahasiswas');
    }
};