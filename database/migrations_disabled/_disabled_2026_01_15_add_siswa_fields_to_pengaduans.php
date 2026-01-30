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
        Schema::table('pengaduans', function (Blueprint $table) {
            // Add siswa_id if it doesn't exist
            if (!Schema::hasColumn('pengaduans', 'siswa_id')) {
                $table->unsignedBigInteger('siswa_id')->nullable()->after('id');
                $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('set null');
            }

            // Add isi_pengaduan if it doesn't exist
            if (!Schema::hasColumn('pengaduans', 'isi_pengaduan')) {
                $table->longText('isi_pengaduan')->nullable()->after('kategori_id');
            }

            // Add tanggal_selesai if it doesn't exist
            if (!Schema::hasColumn('pengaduans', 'tanggal_selesai')) {
                $table->timestamp('tanggal_selesai')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduans', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }
            if (Schema::hasColumn('pengaduans', 'isi_pengaduan')) {
                $table->dropColumn('isi_pengaduan');
            }
            if (Schema::hasColumn('pengaduans', 'tanggal_selesai')) {
                $table->dropColumn('tanggal_selesai');
            }
        });
    }
};
