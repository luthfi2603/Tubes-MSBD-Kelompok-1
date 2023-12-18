<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_kontributors', function (Blueprint $table) {
            $table->char('nim_nidn', 10);
            $table->enum('status', ['penulis','pembimbing', 'kontributor']);
            $table->unsignedInteger('karya_id');
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu');
        });

        DB::unprepared('
            CREATE TRIGGER dont_delete_log_kontributor BEFORE DELETE ON `log_kontributors` FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Tidak dapat menghapus data log kontirbutors";
            END
        ');
        DB::unprepared('
            CREATE TRIGGER dont_update_log_kontributor BEFORE UPDATE ON `log_kontributors` FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Tidak dapat mengubah data log kontirbutors";
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_kontributors');
    }
};