<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('prodis', function (Blueprint $table) {
            $table->char('kode_prodi', 2)->primary();
            $table->string('nama_prodi');
            $table->char('jenjang', 2);
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER log_prodis_insert AFTER INSERT ON `prodis` FOR EACH ROW
            BEGIN
                INSERT INTO log_prodis VALUES (NEW.kode_prodi, NEW.nama_prodi, NEW.jenjang, "INSERT", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_prodis_update AFTER UPDATE ON `prodis` FOR EACH ROW
            BEGIN
                INSERT INTO log_prodis VALUES (NEW.kode_prodi, NEW.nama_prodi, NEW.jenjang, "UPDATE", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_prodis_delete AFTER DELETE ON `prodis` FOR EACH ROW
            BEGIN
                INSERT INTO log_prodis VALUES (OLD.kode_prodi, OLD.nama_prodi, OLD.jenjang, "DELETE", NULL);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};