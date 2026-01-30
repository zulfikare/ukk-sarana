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
        // Drop foreign key constraints first
        Schema::table('input_aspirasis', function (Blueprint $table) {
            $table->dropForeign('input_aspirasis_id_kategori_foreign');
        });

        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropForeign('aspirasis_id_kategori_foreign');
        });

        // Ubah id_kategori menjadi auto-increment
        Schema::table('kategoris', function (Blueprint $table) {
            $table->unsignedInteger('id_kategori')->autoIncrement()->change();
        });

        // Recreate foreign keys
        Schema::table('input_aspirasis', function (Blueprint $table) {
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });

        Schema::table('aspirasis', function (Blueprint $table) {
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraints
        Schema::table('input_aspirasis', function (Blueprint $table) {
            $table->dropForeign('input_aspirasis_id_kategori_foreign');
        });

        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropForeign('aspirasis_id_kategori_foreign');
        });

        Schema::table('kategoris', function (Blueprint $table) {
            $table->unsignedInteger('id_kategori')->noAutoIncrement()->change();
        });

        // Recreate foreign keys
        Schema::table('input_aspirasis', function (Blueprint $table) {
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });

        Schema::table('aspirasis', function (Blueprint $table) {
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }
};

