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
        Schema::create('log_users', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('username');
            $table->string('email');
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_users');
    }
};
