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
                    IF(status = 1) THEN
                        INSERT INTO users (username, status, email, password, created_at, updated_at) VALUES (usernamep, "mahasiswa", emailp, passwordp, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
                        SELECT id INTO id_temp from users ORDER BY id DESC LIMIT 1;
                        UPDATE mahasiswas SET user_id = id_temp WHERE nim = kode COLLATE utf8mb4_unicode_ci;
                    ELSE
                        INSERT INTO users (username, status, email, password, created_at, updated_at) VALUES (usernamep, "dosen", emailp, passwordp, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
                        SELECT id INTO id_temp from users ORDER BY id DESC LIMIT 1;
                        UPDATE dosens SET user_id = id_temp WHERE nidn = kode COLLATE utf8mb4_unicode_ci;
                    END IF;
                ELSE
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "NIM/NIDN tidak terdaftar atau anda telah memiliki akun";
                END IF;
            END
        ');

        DB::unprepared('
            DROP VIEW IF EXISTS view_profile_mahasiswa;
            CREATE VIEW view_profile_mahasiswa AS
            SELECT
                a.username,
                a.email,
                b.nama,
                b.nim,
                b.angkatan,
                b.jenis_kelamin,
                b.status,
                c.nama_prodi
            FROM users a
            INNER JOIN mahasiswas b ON a.id = b.user_id
            INNER JOIN prodis c ON b.kode_prodi = c.kode_prodi;
        ');
        
        DB::unprepared('
            DROP VIEW IF EXISTS view_profile_dosen;
            CREATE VIEW view_profile_dosen AS
            SELECT
                a.username,
                a.email,
                b.nama,
                b.nip,
                b.nidn,
                b.jenis_kelamin,
                c.nama_prodi
            FROM users a
            INNER JOIN dosens b ON a.id = b.user_id
            INNER JOIN prodis c ON b.kode_prodi = c.kode_prodi;
        ');
        
        DB::unprepared('
            DROP VIEW IF EXISTS view_list_karya;
            CREATE VIEW view_list_karya AS
            SELECT 
                a.judul, 
                a.abstrak, 
                a.jenis, 
                a.tahun, 
                c.nama AS penulis, 
                a.url_file
            FROM karya_tulis a 
            INNER JOIN kontributor_mahasiswas b ON a.id = b.karya_id 
            INNER JOIN mahasiswas c ON b.nim = c.nim 
            WHERE b.status = "penulis"
            UNION
            SELECT
				a.judul, 
                a.abstrak, 
                a.jenis, 
                a.tahun, 
                e.nama AS penulis, 
                a.url_file
            FROM karya_tulis a 
            INNER JOIN kontributor_dosens d ON a.id = d.karya_id 
            INNER JOIN dosens e ON d.nidn = e.nidn
            WHERE d.status = "penulis"
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