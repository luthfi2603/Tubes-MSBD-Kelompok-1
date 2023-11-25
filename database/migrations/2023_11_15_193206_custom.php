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
            CREATE PROCEDURE tes(IN nimp char(9))
            BEGIN
                UPDATE mahasiswas SET user_id = 2 WHERE nim = nimp;
            END
        ');

        DB::unprepared('
            DROP FUNTION IF EXISTS cek_akun;

        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS create_user;
            CREATE PROCEDURE create_user(IN usernamep VARCHAR(255), IN emailp VARCHAR(255), IN passwordp VARCHAR(255), IN kode char(10), IN status int(1))
            BEGIN
                DECLARE id_temp int;
                DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
        
                START TRANSACTION;
                IF (status = 1 OR status = 2) THEN
                    INSERT INTO users (username, status, email, password) VALUES (usernamep, "civitas", emailp, passwordp);
                ELSEIF (status = 3) THEN
                    INSERT INTO users (username, status, email, password) VALUES (usernamep, "admin", emailp, passwordp);
                END IF;

                SELECT id INTO id_temp from users ORDER BY id DESC LIMIT 1;
                
                IF (status = 1) THEN
                    UPDATE mahasiswas SET user_id = id_temp WHERE nim = kode COLLATE utf8mb4_unicode_ci;
                ELSEIF (status = 2) THEN
                    UPDATE dosens SET user_id = id_temp WHERE nidn = kode COLLATE utf8mb4_unicode_ci;
                ELSEIF (status = 3) THEN
                    UPDATE admins SET user_id = id_temp WHERE id = kode COLLATE utf8mb4_unicode_ci;
                END IF;
                COMMIT;
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
