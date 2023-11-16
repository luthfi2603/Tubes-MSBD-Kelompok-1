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
            CREATE PROCEDURE tes(IN id INT)
            BEGIN
                INSERT INTO user (username, email, password) VALUES ("tes","tes@gmail", "1");
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
