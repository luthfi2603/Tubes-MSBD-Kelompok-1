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
        DB::unprepared('
            DROP PROCEDURE IF EXISTS tes;
            CREATE PROCEDURE tes(IN id INT)
            BEGIN
                INSERT INTO user (username, email, password) VALUES ("tes","tes@gmail", "1");
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS create_user;
            CREATE PROCEDURE create_user(IN usernamep VARCHAR(255), IN emailp VARCHAR(255), IN passwordp VARCHAR(255), IN kode char(9), IN status int(1))
            BEGIN
                DECLARE id_temp int;
                INSERT INTO users (username, email, password) VALUES (usernamep, emailp, passwordp);

                SELECT id into id_temp from users ORDER BY id DESC LIMIT 1;

                IF (status = 1) THEN
                    UPDATE mahasiswas SET user_id = id_temp WHERE nim = kode;
                ELSEIF (status = 2) THEN
                    UPDATE dosens SET user_id = id_temp WHERE nim = kode;
                END IF;
            END
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
