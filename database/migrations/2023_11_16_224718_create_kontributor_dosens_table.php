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
        Schema::create('kontributor_dosens', function (Blueprint $table) {
            $table->char('nidn', 10);
            $table->foreign('nidn')->references('nidn')->on('dosens')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('status', ['penulis','pembimbing', 'kontributor']);
            $table->unsignedInteger('karya_id');
            $table->foreign('karya_id')->references('id')->on('karya_tulis')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::unprepared('
            CREATE TRIGGER log_kontributor_dosens_insert AFTER INSERT ON `kontributor_dosens` FOR EACH ROW
            BEGIN
                INSERT INTO log_kontributors VALUES (NEW.nidn, NEW.status, NEW.karya_id, "INSERT", CURRENT_TIMESTAMP());
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_kontributor_dosens_update AFTER UPDATE ON `kontributor_dosens` FOR EACH ROW
            BEGIN
                INSERT INTO log_kontributors VALUES (NEW.nidn, NEW.status, NEW.karya_id, "UPDATE", CURRENT_TIMESTAMP());
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_kontributor_dosens_delete AFTER DELETE ON `kontributor_dosens` FOR EACH ROW
            BEGIN
                INSERT INTO log_kontributors VALUES (OLD.nidn, OLD.status, OLD.karya_id, "DELETE", CURRENT_TIMESTAMP());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontributor_dosens');
    }
};