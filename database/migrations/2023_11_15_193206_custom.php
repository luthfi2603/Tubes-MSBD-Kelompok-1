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
            DROP FUNCTION IF EXISTS cekAkun;
            CREATE FUNCTION cekAkun(status INT(1), kode CHAR(10))
            RETURNS BOOLEAN
            BEGIN
                IF(status = 1) THEN
                    IF(SELECT COUNT(*) FROM mahasiswas WHERE nim = kode COLLATE utf8mb4_unicode_ci AND (SELECT user_id FROM mahasiswas WHERE nim = kode COLLATE utf8mb4_unicode_ci) = 1) THEN
                        RETURN 1;
                    ELSE
                        RETURN 0;
                    END IF;
                ELSE
                    IF(SELECT COUNT(*) FROM dosens WHERE nidn = kode COLLATE utf8mb4_unicode_ci AND (SELECT user_id FROM dosens WHERE nidn = kode COLLATE utf8mb4_unicode_ci) = 1) THEN
                        RETURN 1;
                    ELSE
                        RETURN 0;
                    END IF;
                END IF;
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS createUser;
            CREATE PROCEDURE createUser(IN usernamep VARCHAR(255), IN emailp VARCHAR(255), IN passwordp VARCHAR(255), IN kode char(10), IN status int(1))
            BEGIN
                DECLARE id_temp INT;

                IF(cekAkun(status, kode)) THEN
                    INSERT INTO users (username, status, email, password) VALUES (usernamep, "civitas", emailp, passwordp);

                    SELECT id INTO id_temp from users ORDER BY id DESC LIMIT 1;
                    
                    IF(status = 1) THEN
                        UPDATE mahasiswas SET user_id = id_temp WHERE nim = kode COLLATE utf8mb4_unicode_ci;
                    ELSE
                        UPDATE dosens SET user_id = id_temp WHERE nidn = kode COLLATE utf8mb4_unicode_ci;
                    END IF;
                ELSE
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "NIM/NIDN tidak terdaftar atau anda telah memiliki akun";
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