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
            // Add lokasi column if it doesn't exist
            if (!Schema::hasColumn('pengaduans', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('kategori_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduans', 'lokasi')) {
                $table->dropColumn('lokasi');
            }
        });
    }
};
