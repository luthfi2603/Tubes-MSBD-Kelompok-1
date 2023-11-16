<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->enum('status', ['admin','super_admin']);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER log_admins_insert AFTER INSERT ON `admins` FOR EACH ROW
            BEGIN
                INSERT INTO log_admins VALUES (NEW.id, NEW.nama, NEW.status, NEW.user_id, "INSERT", NULL);
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_admins_update AFTER UPDATE ON `admins` FOR EACH ROW
            BEGIN
                INSERT INTO log_admins VALUES (NEW.id, NEW.nama, NEW.status, NEW.user_id, "UPDATE", NULL);
            END
        ');
        
        DB::unprepared('
            CREATE TRIGGER log_admins_delete AFTER DELETE ON `admins` FOR EACH ROW
            BEGIN
                INSERT INTO log_admins VALUES (OLD.id, OLD.nama, OLD.status, OLD.user_id, "DELETE", NULL);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('admins');
    }
};