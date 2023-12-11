<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
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
            DROP PROCEDURE IF EXISTS createAdmin;
            CREATE PROCEDURE createAdmin(IN usernamep VARCHAR(255), IN emailp VARCHAR(255), IN passwordp VARCHAR(255), IN namap varchar(255))
            BEGIN
                DECLARE id_temp INT;
                INSERT INTO users (username, status, email, password, created_at, updated_at) VALUES (usernamep, "admin", emailp, passwordp, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
                SELECT id INTO id_temp from users ORDER BY id DESC LIMIT 1;
                INSERT INTO admins (nama, user_id) VALUES (namap, id_temp);
            END
        ');
        DB::unprepared('
            DROP PROCEDURE IF EXISTS updateAdmin;
            CREATE PROCEDURE updateAdmin(IN usernamep VARCHAR(255), IN emailp VARCHAR(255), IN verif int(1), IN namap varchar(255), IN idp int(10), IN idu int(10))
            BEGIN
                IF(verif = 1) THEN
                    UPDATE users SET username = usernamep, email = emailp, email_verified_at = NULL WHERE id = idu; 
                    UPDATE admins SET nama = namap WHERE id = idp;
                ELSE
                    UPDATE users SET username = usernamep WHERE id = idu;
                    UPDATE admins SET nama = namap WHERE id = idp;
                END IF;
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS deleteAdmin;
            CREATE PROCEDURE deleteAdmin(IN idp int(10), IN idu int(10))
            BEGIN
                DELETE FROM admins WHERE id = idp;
                DELETE FROM users WHERE id = idu;
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS createKaryaTulis;
            CREATE PROCEDURE createKaryaTulis(
                IN judulp varchar(500),
                IN abstrakp text,
                bidang_ilmup varchar(255),
                url_filep varchar(255),
                jenisp varchar(255),
                tahunp varchar(255),
                diupload_olehp varchar(255),
                kunci JSON,
                nim_nip JSON
            )
            BEGIN
                
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

        /* DB::unprepared('
            DROP VIEW IF EXISTS view_list_karya;
            CREATE VIEW view_list_karya AS
            SELECT 
                a.id,
                a.judul, 
                a.abstrak, 
                a.jenis, 
                a.tahun, 
                c.nama AS penulis, 
                a.url_file,
                c.kode_prodi
            FROM karya_tulis a 
            INNER JOIN kontributor_mahasiswas b ON a.id = b.karya_id 
            INNER JOIN mahasiswas c ON b.nim = c.nim 
            WHERE b.status = "penulis"
            UNION
            SELECT
                a.id,
				a.judul, 
                a.abstrak, 
                a.jenis, 
                a.tahun, 
                c.nama AS penulis, 
                a.url_file,
                c.kode_prodi
            FROM karya_tulis a 
            INNER JOIN kontributor_dosens b ON a.id = b.karya_id 
            INNER JOIN dosens c ON b.nidn = c.nidn
            WHERE b.status = "penulis"
        '); */

        DB::unprepared('
            DROP FUNCTION IF EXISTS hitungAll;
            CREATE FUNCTION hitungAll()
            RETURNS INT 
            BEGIN
                DECLARE jlh_k INT;
                DECLARE jlh_e INT;

                SELECT COUNT(*) INTO jlh_k FROM karya_tulis;
                SELECT COUNT(*) INTO jlh_e FROM ebooks;

                RETURN jlh_k + jlh_e;
            END
        ');

        DB::unprepared('
            DROP FUNCTION IF EXISTS hitungJumlah;
            CREATE FUNCTION hitungJumlah(jenisp VARCHAR(255))
            RETURNS INT
            BEGIN 
                RETURN (SELECT COUNT(*) FROM karya_tulis WHERE jenis = jenisp COLLATE utf8mb4_unicode_ci); 
            END
        ');

        DB::unprepared('
            DROP VIEW IF EXISTS view_statistik;
            CREATE VIEW view_statistik AS
            SELECT
                a.jenis_tulisan,
                hitungJumlah(a.jenis_tulisan) AS jumlah_karya
            FROM jenis_tulisans a
        ');

        DB::unprepared('
            DROP FUNCTION IF EXISTS hitungLikeKarya;
            CREATE FUNCTION hitungLikeKarya(karya_idp INT(10))
            RETURNS INT
            BEGIN
                RETURN (SELECT COUNT(*) FROM favorites WHERE karya_id = karya_idp);
            END
        ');

        DB::unprepared('
            DROP VIEW IF EXISTS view_most_like;
            CREATE VIEW view_most_like AS
            SELECT
                a.id,
                a.judul,
                hitungLikeKarya(a.id) AS jumlah_like
            FROM karya_tulis a ORDER BY jumlah_like DESC
        ');

        DB::unprepared("
            DROP FUNCTION IF EXISTS hitungLikeAuthor;
            CREATE FUNCTION hitungLikeAuthor(Author_idp char(10), statusp int(1))
            RETURNS INT
            BEGIN
                DECLARE jlh_like INT;
                IF (statusp = 1) THEN
                    SELECT COUNT(*) into jlh_like FROM favorites WHERE karya_id IN(SELECT DISTINCT karya_id FROM kontributor_mahasiswas WHERE status = CAST('penulis' AS CHAR) AND nim = Author_idp COLLATE utf8mb4_unicode_ci);
                    RETURN jlh_like;
                ELSEIF (statusp = 2) THEN
                    SELECT COUNT(*) into jlh_like FROM favorites WHERE karya_id IN(SELECT DISTINCT karya_id FROM kontributor_dosens WHERE status = CAST('penulis' AS CHAR) AND nidn = Author_idp COLLATE utf8mb4_unicode_ci);
                    RETURN jlh_like;
                END IF;
            END
        ");

        DB::unprepared('
            DROP VIEW IF EXISTS view_top_author;
            CREATE VIEW view_top_author AS
            SELECT
                a.nama,
                hitungLikeAuthor(a.nim, 1) AS jumlah_like
            FROM mahasiswas a
            UNION
            SELECT
                a.nama,
                hitungLikeAuthor(a.nidn, 2) AS jumlah_like
            FROM dosens a ORDER BY jumlah_like DESC
        ');

        /* DB::unprepared('
            DROP VIEW IF EXISTS view_detail_karya_tulis;
            CREATE VIEW view_detail_karya_tulis AS
            SELECT 
                a.id,
                a.judul, 
                a.abstrak, 
                a.url_file,
                a.bidang_ilmu,
                a.jenis, 
                a.tahun, 
                a.view,
                d.kata_kunci,
                c.nama AS kontributor,
                b.status
            FROM karya_tulis a 
            INNER JOIN kontributor_mahasiswas b ON a.id = b.karya_id 
            INNER JOIN mahasiswas c ON b.nim = c.nim 
            INNER JOIN kata_kunci_tulisans d ON a.id = d.karya_id
            UNION
            SELECT
                a.id,
                a.judul, 
                a.abstrak, 
                a.url_file,
                a.bidang_ilmu,
                a.jenis, 
                a.tahun, 
                a.view,
                d.kata_kunci,
                c.nama AS kontributor,
                b.status
            FROM karya_tulis a 
            INNER JOIN kontributor_dosens b ON a.id = b.karya_id 
            INNER JOIN dosens c ON b.nidn = c.nidn
            INNER JOIN kata_kunci_tulisans d ON a.id = d.karya_id
            ORDER BY `id` ASC
        '); */

        DB::unprepared('
            DROP VIEW IF EXISTS view_karya_tulis;
            CREATE VIEW view_karya_tulis AS
            SELECT 
                a.id,
                a.judul, 
                a.abstrak, 
                a.url_file,
                a.bidang_ilmu,
                a.jenis, 
                a.tahun, 
                a.view,
                d.kata_kunci,
                c.nama AS kontributor,
                b.status,
                e.kode_prodi
            FROM karya_tulis a 
            INNER JOIN kontributor_mahasiswas b ON a.id = b.karya_id 
            INNER JOIN mahasiswas c ON b.nim = c.nim 
            INNER JOIN kata_kunci_tulisans d ON a.id = d.karya_id
            INNER JOIN prodis e ON c.kode_prodi = e.kode_prodi
            UNION
            SELECT
                a.id,
                a.judul, 
                a.abstrak, 
                a.url_file,
                a.bidang_ilmu,
                a.jenis, 
                a.tahun, 
                a.view,
                d.kata_kunci,
                c.nama AS kontributor,
                b.status,
                e.kode_prodi
            FROM karya_tulis a 
            INNER JOIN kontributor_dosens b ON a.id = b.karya_id 
            INNER JOIN dosens c ON b.nidn = c.nidn
            INNER JOIN kata_kunci_tulisans d ON a.id = d.karya_id            
            INNER JOIN prodis e ON c.kode_prodi = e.kode_prodi
            ORDER BY `id` ASC
        ');

        DB::unprepared('
            DROP VIEW IF EXISTS view_all_user;
            CREATE VIEW view_all_user AS
            SELECT
                a.id,
                a.username,
                a.email,
                b.nama,
                b.nim AS nim_nidn,
                "mahasiswa" AS status,
                b.kode_prodi
            FROM users a
            INNER JOIN mahasiswas b ON a.id = b.user_id
            WHERE a.id <> 1
            UNION
            SELECT
                a.id,
                a.username,
                a.email,
                b.nama,
                b.nidn AS nim_nidn,
                "dosen" AS status,
                b.kode_prodi
            FROM users a
            INNER JOIN dosens b ON a.id = b.user_id
            WHERE a.id <> 1 
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS deleteUser;
            CREATE PROCEDURE deleteUser(IN kode char(10), IN status int(1), IN user_id int(10))
            BEGIN
                IF(status = 1) THEN
                    UPDATE mahasiswas SET user_id = 1 WHERE nim = kode COLLATE utf8mb4_unicode_ci;
                ELSE
                    UPDATE dosens SET user_id = 1 WHERE nidn = kode COLLATE utf8mb4_unicode_ci;
                END IF;
                DELETE FROM users WHERE id = user_id; 
            END
        ');

        DB::unprepared('
            DROP VIEW IF EXISTS view_pegawai_user;
            CREATE VIEW view_pegawai_user AS
            SELECT
                a.id,
                a.username,
                a.email,
                b.nama,
                b.id AS pegawai_id
            FROM users a
            INNER JOIN admins b ON a.id = b.user_id
            WHERE a.status <> "super_admin"
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {

        //
    }
};