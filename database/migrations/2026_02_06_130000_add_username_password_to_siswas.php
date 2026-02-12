<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            if (!Schema::hasColumn('siswas', 'username')) {
                $table->string('username', 50)->nullable()->after('nis');
            }
            if (!Schema::hasColumn('siswas', 'password')) {
                $table->string('password')->nullable()->after('username');
            }
        });

        // Set default usernames from NIS for existing records
        try {
            DB::statement('UPDATE siswas SET username = CONCAT("siswa_", nis) WHERE username IS NULL');
        } catch (\Exception $e) {
            // If update fails, continue - manual intervention may be needed
        }
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            if (Schema::hasColumn('siswas', 'username')) {
                $table->dropColumn('username');
            }
            if (Schema::hasColumn('siswas', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};

