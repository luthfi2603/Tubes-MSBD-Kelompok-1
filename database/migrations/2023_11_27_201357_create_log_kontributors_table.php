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
        Schema::create('log_kontributors', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->char('nim_nidn', 10);
            $table->enum('status', ['penulis','pembimbing', 'kontributor']);
            $table->unsignedInteger('karya_id');
            $table->enum('action', ['INSERT','UPDATE', 'DELETE']);
            $table->timestamp('waktu')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_kontributors');
    }
};
