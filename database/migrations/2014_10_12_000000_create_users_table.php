<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER log_users_insert AFTER INSERT ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO log_users VALUES (NEW.id, NEW.username, NEW.email, "INSERT", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_users_update AFTER UPDATE ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO log_users VALUES (NEW.id, NEW.username, NEW.email, "UPDATE", NULL);
            END
        ');
        DB::unprepared('
            CREATE TRIGGER log_users_delete AFTER DELETE ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO log_users VALUES (OLD.id, OLD.username, OLD.email, "DELETE", NULL);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
    }
};