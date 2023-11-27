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
        Schema::create('kontributor_mahasiswas', function (Blueprint $table) {
            $table->char('nim', 9);
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('status', ['penulis', 'kontributor']);
            $table->unsignedInteger('karya_id');
            $table->foreign('karya_id')->references('id')->on('karya_tulis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontributor_mahasiswas');
    }
};
