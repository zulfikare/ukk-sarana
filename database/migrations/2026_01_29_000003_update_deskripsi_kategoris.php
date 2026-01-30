<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('kategoris')->where('id_kategori', 1)->update(['deskripsi' => 'Sarana pendidikan adalah perangkat keras dan perlengkapan yang mendukung proses pembelajaran di sekolah']);
        DB::table('kategoris')->where('id_kategori', 2)->update(['deskripsi' => 'Prasarana pendidikan adalah fasilitas fisik dan infrastruktur yang menunjang kegiatan belajar mengajar']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('kategoris')->update(['deskripsi' => null]);
    }
};
