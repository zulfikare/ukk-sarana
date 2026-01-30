<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This migration cleans up deprecated tables and fields
// Run this AFTER fresh migration if needed

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop old pengaduans table if it exists
        if (Schema::hasTable('pengaduans')) {
            Schema::drop('pengaduans');
        }

        // Note: Other deprecated migrations are already handled by fresh migration
        // This file is for reference and cleanup if needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting deprecated migrations is not recommended
        // Use fresh migration instead
    }
};
