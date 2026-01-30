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
        // Update existing siswa dengan nama
        DB::table('siswas')->where('nis', 12001)->update(['nama' => 'Ahmad Hidayat']);
        DB::table('siswas')->where('nis', 12002)->update(['nama' => 'Budi Santoso']);
        DB::table('siswas')->where('nis', 12003)->update(['nama' => 'Cindy Wijaya']);
        DB::table('siswas')->where('nis', 12004)->update(['nama' => 'Dewi Kusuma']);
        DB::table('siswas')->where('nis', 12005)->update(['nama' => 'Eka Prasetyo']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('siswas')->update(['nama' => null]);
    }
};
