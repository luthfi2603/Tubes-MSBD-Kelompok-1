<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kontributor_mahasiswas', function (Blueprint $table) {
            $table->char('nim', 9);
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('restrict')->onUpdate('cascade');
            $table->string('status', 50);
            $table->foreign('status')->references('nama_status')->on('statuses')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('karya_id');
            $table->foreign('karya_id')->references('id')->on('karya_tulis')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::unprepared('
            CREATE TRIGGER log_kontributor_mahasiswas_insert AFTER INSERT ON `kontributor_mahasiswas` FOR EACH ROW
            BEGIN
                INSERT INTO log_kontributors VALUES (NEW.nim, NEW.status, NEW.karya_id, "INSERT", CURRENT_TIMESTAMP());
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_kontributor_mahasiswas_update AFTER UPDATE ON `kontributor_mahasiswas` FOR EACH ROW
            BEGIN
                INSERT INTO log_kontributors VALUES (NEW.nim, NEW.status, NEW.karya_id, "UPDATE", CURRENT_TIMESTAMP());
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_kontributor_mahasiswas_delete AFTER DELETE ON `kontributor_mahasiswas` FOR EACH ROW
            BEGIN
                INSERT INTO log_kontributors VALUES (OLD.nim, OLD.status, OLD.karya_id, "DELETE", CURRENT_TIMESTAMP());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontributor_mahasiswas');
    }
};