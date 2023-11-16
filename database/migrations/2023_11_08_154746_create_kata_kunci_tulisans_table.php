<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kata_kunci_tulisans', function (Blueprint $table) {
            $table->unsignedInteger('karya_id');
            $table->foreign('karya_id')->references('id')->on('karya_tulis')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kata_kunci', 20);
            $table->foreign('kata_kunci')->references('kata_kunci')->on('kata_kuncis')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kata_kunci_tulisans');
    }
};
