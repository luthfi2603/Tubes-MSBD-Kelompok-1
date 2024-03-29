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
            DROP PROCEDURE IF EXISTS trigger_delete_karya_tulis;
            CREATE PROCEDURE trigger_delete_karya_tulis(IN adminp VARCHAR(255), IN karya_idp INT)
            BEGIN
                INSERT INTO log_karya_tulis(judul, abstrak, bidang_ilmu, url_file, jenis, tahun, diupload_oleh, action, waktu) SELECT judul, abstrak, bidang_ilmu, url_file, jenis, tahun, adminp, "DELETE", CURRENT_TIMESTAMP() FROM karya_tulis WHERE id = karya_idp;
                DELETE FROM karya_tulis WHERE id = karya_idp;
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS trigger_delete_ebook;
            CREATE PROCEDURE trigger_delete_ebook(IN adminp VARCHAR(255), IN ebook_id INT)
            BEGIN
                INSERT INTO log_ebooks(judul, penulis, url_file, tahun_terbit, diupload_oleh, action, waktu) SELECT judul, penulis, url_file, tahun_terbit, adminp, "DELETE", CURRENT_TIMESTAMP() FROM ebooks WHERE id = ebook_id;
                DELETE FROM ebooks WHERE id = ebook_id;
            END
        ');

        DB::unprepared("
            DROP PROCEDURE IF EXISTS createKaryaTulis;
            CREATE PROCEDURE createKaryaTulis(
                IN judulp varchar(500),
                IN abstrakp text,
                bidang_ilmup varchar(255),
                url_filep varchar(255),
                jenisp varchar(255),
                tahunp varchar(255),
                uploadp varchar(255),
                kolabp JSON,
                kuncip JSON
            )
            BEGIN
                DECLARE i INT DEFAULT 0;
                DECLARE j INT DEFAULT 0;
                DECLARE kuncit VARCHAR(255);
                DECLARE karya_idt INT;
                DECLARE nim_nidnt char(10);
                DECLARE tingkatant INT;
                DECLARE statust VARCHAR(50);
                DECLARE id_temp INT;
                DECLARE pivot TINYINT(1);

                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    ROLLBACK;
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                END;

                START TRANSACTION;
            
                CREATE TEMPORARY TABLE temp_kunci (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    karya_id INT,
                    kunci VARCHAR(255)
                );
                CREATE TEMPORARY TABLE temp_kolab (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nim_nidn char(10),
                    status VARCHAR(50),
                    karya_id INT,
                    tingkat INT
                );
            
                INSERT INTO karya_tulis (judul, abstrak, bidang_ilmu, url_file, jenis, tahun, view, diupload_oleh, created_at, updated_at) VALUES(judulp, abstrakp, bidang_ilmup, url_filep, jenisp, tahunp, 0, uploadp, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
                SELECT LAST_INSERT_ID() INTO id_temp;
            
                WHILE i < JSON_LENGTH(kuncip) DO
                    SET kuncit = JSON_UNQUOTE(JSON_EXTRACT(kuncip, CONCAT('$[', i, '].kunci')));
            
                    INSERT INTO temp_kunci (karya_id, kunci) VALUES (id_temp, kuncit);
                    SET i = i + 1;
                END WHILE;
                INSERT INTO kata_kunci_tulisans (karya_id, kata_kunci) SELECT karya_id, kunci FROM temp_kunci;
                DROP TEMPORARY TABLE IF EXISTS temp_kunci;
  
                WHILE j < JSON_LENGTH(kolabp) DO
                    SET nim_nidnt = JSON_UNQUOTE(JSON_EXTRACT(kolabp, CONCAT('$[', j, '].nim_nidn')));
                    SET tingkatant = CAST(JSON_UNQUOTE(JSON_EXTRACT(kolabp, CONCAT('$[', j, '].tingkatan'))) AS SIGNED);
                    SET statust = JSON_UNQUOTE(JSON_EXTRACT(kolabp, CONCAT('$[', j, '].status')));

                    SELECT status INTO pivot FROM statuses WHERE nama_status = statust COLLATE utf8mb4_unicode_ci;

                    IF(tingkatant = 1 AND pivot) THEN
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                    END IF;

                    INSERT INTO temp_kolab (nim_nidn, status ,karya_id, tingkat) VALUES (nim_nidnt, statust ,id_temp, tingkatant);
                    SET j = j + 1;
                END WHILE;

                INSERT INTO kontributor_mahasiswas (nim, status, karya_id) SELECT nim_nidn, status, karya_id FROM temp_kolab WHERE tingkat = 1;
                INSERT INTO kontributor_dosens (nidn, status, karya_id) SELECT nim_nidn, status, karya_id FROM temp_kolab WHERE tingkat = 2;
                DROP TEMPORARY TABLE IF EXISTS temp_kolab;

                COMMIT;
            END 
        ");

        DB::unprepared("
            DROP PROCEDURE IF EXISTS editKaryaTulis;
            CREATE PROCEDURE editKaryaTulis(
                IN judulp varchar(500),
                IN abstrakp text,
                IN bidang_ilmup varchar(255),
                IN url_filep varchar(255),
                IN jenisp varchar(255),
                IN tahunp varchar(255),
                IN karya_idp INT,
                IN uploadp varchar(255),
                IN kolabp JSON,
                IN kuncip JSON
            )
            BEGIN
                DECLARE i INT DEFAULT 0;
                DECLARE j INT DEFAULT 0;
                DECLARE kuncit VARCHAR(255);
                DECLARE nim_nidnt char(10);
                DECLARE tingkatant INT;
                DECLARE statust VARCHAR(50);
                DECLARE kondisi INT;
                DECLARE pivot TINYINT(1);
            
                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    ROLLBACK;
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                END;
            
                START TRANSACTION;
            
                CREATE TEMPORARY TABLE temp_kunci (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    karya_id INT,
                    kunci VARCHAR(255)
                );
                CREATE TEMPORARY TABLE temp_kolab (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nim_nidn char(10),
                    tingkat INT
                );
            
                UPDATE karya_tulis SET judul = judulp, abstrak = abstrakp, bidang_ilmu = bidang_ilmup, url_file = url_filep, jenis = jenisp, tahun = tahunp, diupload_oleh = uploadp WHERE id = karya_idp;
            
                WHILE i < JSON_LENGTH(kuncip) DO 
                    SET kuncit = JSON_UNQUOTE(JSON_EXTRACT(kuncip, CONCAT('$[', i, '].kunci')));
            
                    INSERT INTO temp_kunci (karya_id, kunci) VALUES (karya_idp, kuncit);
                    SET i = i + 1;
                END WHILE;
            
                DELETE FROM kata_kunci_tulisans WHERE karya_id = karya_idp;
                INSERT INTO kata_kunci_tulisans (karya_id, kata_kunci) SELECT karya_id, kunci FROM temp_kunci;
                DROP TEMPORARY TABLE IF EXISTS temp_kunci;
            
                WHILE j < JSON_LENGTH(kolabp) DO 
                    SET nim_nidnt = JSON_UNQUOTE(JSON_EXTRACT(kolabp, CONCAT('$[', j, '].nim_nidn')));
                    SET statust = JSON_UNQUOTE(JSON_EXTRACT(kolabp, CONCAT('$[', j, '].status')));
                    SET tingkatant = CAST(JSON_UNQUOTE(JSON_EXTRACT(kolabp, CONCAT('$[', j, '].tingkatan'))) AS SIGNED);
                    SET kondisi = CAST(JSON_UNQUOTE(JSON_EXTRACT(kolabp, CONCAT('$[', j, '].kondisi'))) AS SIGNED);
            
                    IF(kondisi = 1 AND tingkatant = 1) THEN
                        SELECT COUNT(*) INTO pivot FROM kontributor_mahasiswas WHERE nim = nim_nidnt COLLATE utf8mb4_unicode_ci;
                    ELSEIF(kondisi = 1 AND tingkatant = 2) THEN
                        SELECT COUNT(*) INTO pivot FROM kontributor_dosens WHERE nidn = nim_nidnt COLLATE utf8mb4_unicode_ci;
                    END IF;

                    IF(pivot = 0) THEN
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                    END IF;

                    IF (kondisi = 2 AND tingkatant = 1) THEN
                        SELECT COUNT(*) INTO pivot FROM kontributor_mahasiswas WHERE nim = nim_nidnt COLLATE utf8mb4_unicode_ci;
                        IF(pivot = 0) THEN
                            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                        END IF;

                        SELECT status INTO pivot FROM statuses WHERE nama_status = statust COLLATE utf8mb4_unicode_ci;

                        IF(pivot) THEN
                            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                        END IF;

                        UPDATE kontributor_mahasiswas SET status = statust WHERE nim = nim_nidnt COLLATE utf8mb4_unicode_ci AND karya_id = karya_idp;
                    ELSEIF (kondisi = 2 AND tingkatant = 2) THEN
                        SELECT COUNT(*) INTO pivot FROM kontributor_dosens WHERE nidn = nim_nidnt COLLATE utf8mb4_unicode_ci;
                        IF(pivot = 0) THEN
                            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                        END IF;

                        UPDATE kontributor_dosens SET status = statust WHERE nidn = nim_nidnt COLLATE utf8mb4_unicode_ci AND karya_id = karya_idp;
                    ELSEIF (kondisi = 3 AND tingkatant = 1) THEN
                        SELECT status INTO pivot FROM statuses WHERE nama_status = statust COLLATE utf8mb4_unicode_ci;

                        IF(pivot) THEN
                            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'error';
                        END IF;

                        INSERT INTO kontributor_mahasiswas VALUES (nim_nidnt, statust, karya_idp);
                    ELSEIF (kondisi = 3 AND tingkatant = 2) THEN
                        INSERT INTO kontributor_dosens VALUES (nim_nidnt, statust, karya_idp);
                    END IF;
            
                    IF (tingkatant = 1) THEN
                        INSERT INTO temp_kolab (nim_nidn, tingkat) VALUES (nim_nidnt, 1);
                    ELSE
                        INSERT INTO temp_kolab (nim_nidn, tingkat) VALUES (nim_nidnt, 2);
                    END IF;
            
                    SET j = j + 1;
                    SET pivot = 1;
                END WHILE;
            
                DELETE FROM kontributor_mahasiswas WHERE karya_id = karya_idp AND nim NOT IN (SELECT nim_nidn COLLATE utf8mb4_unicode_ci FROM temp_kolab WHERE tingkat = 1);
                DELETE FROM kontributor_dosens WHERE karya_id = karya_idp AND nidn NOT IN(SELECT nim_nidn COLLATE utf8mb4_unicode_ci FROM temp_kolab WHERE tingkat = 2); 
                
                DROP TEMPORARY TABLE IF EXISTS temp_kolab;
            
                COMMIT;
            END
        ");

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
                a.email_verified_at,
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
                a.email_verified_at,
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

        DB::unprepared('
            DROP VIEW IF EXISTS view_list_log;
            CREATE VIEW view_list_log AS 
            SELECT
                a.action,
                "Karya Tulis" AS tabel,
                a.judul,
                a.diupload_oleh,
                a.waktu
            FROM log_karya_tulis a 
            UNION
            SELECT
                a.action,
                "E-Book" AS tabel,
                a.judul,
                a.diupload_oleh,
                a.waktu
            FROM log_ebooks a 
            ORDER BY waktu
        ');

        DB::unprepared("
            DROP USER IF EXISTS 'guest'@'localhost';
            CREATE USER 'guest'@'localhost' IDENTIFIED BY 'passwordGuest';
            -- GRANT SELECT ON repositori.* TO 'guest'@'localhost';
            GRANT SELECT ON repositori.jenis_tulisans TO 'guest'@'localhost';
            GRANT SELECT ON repositori.prodis TO 'guest'@'localhost';
            GRANT SELECT ON repositori.view_karya_tulis TO 'guest'@'localhost';
            GRANT SELECT ON repositori.favorites TO 'guest'@'localhost';
            GRANT SELECT ON repositori.ebooks TO 'guest'@'localhost';
            GRANT SELECT ON repositori.favorite_ebooks TO 'guest'@'localhost';
            GRANT SELECT ON repositori.bidang_ilmus TO 'guest'@'localhost';
            GRANT SELECT ON repositori.view_most_like TO 'guest'@'localhost';
            GRANT SELECT ON repositori.view_statistik TO 'guest'@'localhost';
            GRANT SELECT ON repositori.view_top_author TO 'guest'@'localhost';
            GRANT SELECT, UPDATE, INSERT ON repositori.users TO 'guest'@'localhost';
            GRANT SELECT, UPDATE (user_id) ON repositori.mahasiswas TO 'guest'@'localhost';
            GRANT SELECT, UPDATE (user_id) ON repositori.dosens TO 'guest'@'localhost';
            GRANT SELECT, UPDATE (view, updated_at) ON repositori.karya_tulis TO 'guest'@'localhost';
            GRANT SELECT, UPDATE (view) ON repositori.ebooks TO 'guest'@'localhost';
            GRANT SELECT, INSERT, DELETE ON repositori.password_reset_tokens TO 'guest'@'localhost';
            GRANT EXECUTE ON FUNCTION repositori.hitungAll TO 'guest'@'localhost';
            GRANT EXECUTE ON PROCEDURE repositori.createUser TO 'guest'@'localhost';
        ");

        DB::unprepared("
            DROP USER IF EXISTS 'mahasiswa'@'localhost';
            CREATE USER 'mahasiswa'@'localhost' IDENTIFIED BY 'passwordUser';
            GRANT SELECT ON repositori.* TO 'mahasiswa'@'localhost';
            GRANT UPDATE ON repositori.users TO 'mahasiswa'@'localhost';
            GRANT INSERT, DELETE ON repositori.favorites TO 'mahasiswa'@'localhost';
            GRANT INSERT, DELETE ON repositori.favorite_ebooks TO 'mahasiswa'@'localhost';
        ");

        DB::unprepared("
            DROP USER IF EXISTS 'dosen'@'localhost';
            CREATE USER 'dosen'@'localhost' IDENTIFIED BY 'passwordUser';
            GRANT SELECT ON repositori.* TO 'dosen'@'localhost';
            GRANT UPDATE ON repositori.users TO 'dosen'@'localhost';
            GRANT INSERT, DELETE ON repositori.favorites TO 'dosen'@'localhost';
            GRANT INSERT, DELETE ON repositori.favorite_ebooks TO 'dosen'@'localhost';
        ");

        DB::unprepared("
            DROP USER IF EXISTS 'admin'@'localhost';
            CREATE USER 'admin'@'localhost' IDENTIFIED BY 'passwordAdmin';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.bidang_ilmus TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.dosens TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.ebooks TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.jenis_tulisans TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.karya_tulis TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.kata_kuncis TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.kata_kunci_tulisans TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.kontributor_dosens TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.kontributor_mahasiswas TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.mahasiswas TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.prodis TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.users TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.view_all_user TO 'admin'@'localhost';
            GRANT SELECT, INSERT, UPDATE, DELETE ON repositori.view_karya_tulis TO 'admin'@'localhost';
            GRANT SELECT ON repositori.statuses TO 'admin'@'localhost';
            GRANT EXECUTE ON repositori.* TO 'admin'@'localhost';
        ");

        DB::unprepared("
            DROP USER IF EXISTS 'super_admin'@'localhost';
            CREATE USER 'super_admin'@'localhost' IDENTIFIED BY 'passwordSuperAdmin';
            GRANT ALL PRIVILEGES ON repositori.* TO 'super_admin'@'localhost';
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {

        //
    }
};