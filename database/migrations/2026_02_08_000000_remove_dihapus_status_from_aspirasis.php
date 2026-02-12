<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First, convert any 'Dihapus' records back to 'Menunggu' or delete them
        DB::statement("UPDATE aspirasis SET status = 'Menunggu' WHERE status = 'Dihapus'");
        
        // Then update the enum to remove 'Dihapus'
        DB::statement("ALTER TABLE aspirasis MODIFY status ENUM('Menunggu', 'Proses', 'Selesai') DEFAULT 'Menunggu'");
    }

    public function down(): void
    {
        // Restore the enum with 'Dihapus' if needed
        DB::statement("ALTER TABLE aspirasis MODIFY status ENUM('Menunggu', 'Proses', 'Selesai', 'Dihapus') DEFAULT 'Menunggu'");
    }
};
