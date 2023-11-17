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
        Schema::create('kontributor_dosens', function (Blueprint $table) {
            $table->char('nidn', 10);
            $table->foreign('nidn')->references('nidn')->on('dosens')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('status', ['penulis','pembimbing', 'kontributor']);
            $table->unsignedInteger('karya_id');
            $table->foreign('karya_id')->references('id')->on('karya_tulis')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontributor_dosens');
    }
};
