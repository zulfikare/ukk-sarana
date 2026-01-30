<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('kategoris')->where('id', 1)->update([
            'nama' => 'Sarana',
            'deskripsi' => 'Aspek pengaduan terkait sarana (peralatan, perlengkapan)'
        ]);

        DB::table('kategoris')->where('id', 2)->update([
            'nama' => 'Prasarana',
            'deskripsi' => 'Aspek pengaduan terkait prasarana (bangunan, ruang, fasilitas)'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('kategoris')->where('id', 1)->update([
            'nama' => 'Kategori 1',
            'deskripsi' => 'Deskripsi kategori 1'
        ]);

        DB::table('kategoris')->where('id', 2)->update([
            'nama' => 'Kategori 2',
            'deskripsi' => 'Deskripsi kategori 2'
        ]);
    }
};
