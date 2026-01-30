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
        Schema::create('input_aspirasis', function (Blueprint $table) {
            $table->integer('id_pelaporan', false, true)->primary();
            $table->integer('nis', false, true);
            $table->integer('id_kategori', false, true);
            $table->string('lokasi', 50)->nullable();
            $table->string('ket', 50)->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirasis');
    }
};
