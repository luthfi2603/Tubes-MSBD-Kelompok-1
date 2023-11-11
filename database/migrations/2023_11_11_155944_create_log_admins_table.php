<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('log_admins', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nama');
            $table->enum('status', ['admin','super_admin']);
            $table->integer('user_id');
            $table->enum('action', ['insert','update', 'delete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('log_admins');
    }
};
