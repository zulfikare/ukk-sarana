<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeNisToVarchar extends Migration
{
    public function up()
    {
        // Drop foreign keys on tables that reference siswas.nis
        try {
            Schema::table('aspirasis', function (Blueprint $table) {
                $table->dropForeign(['nis']);
            });
        } catch (\Exception $e) {
            // ignore if foreign key does not exist or has different name
        }

        if (Schema::hasTable('input_aspirasis')) {
            try {
                Schema::table('input_aspirasis', function (Blueprint $table) {
                    $table->dropForeign(['nis']);
                });
            } catch (\Exception $e) {
                // ignore
            }
        }

        // Change column types using raw SQL to avoid doctrine/dbal dependency
        DB::statement("ALTER TABLE `siswas` MODIFY `nis` VARCHAR(20) NOT NULL");
        DB::statement("ALTER TABLE `aspirasis` MODIFY `nis` VARCHAR(20) NOT NULL");
        if (Schema::hasTable('input_aspirasis')) {
            DB::statement("ALTER TABLE `input_aspirasis` MODIFY `nis` VARCHAR(20) NOT NULL");
        }

        // Recreate foreign keys with ON UPDATE CASCADE
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->foreign('nis')
                ->references('nis')
                ->on('siswas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        if (Schema::hasTable('input_aspirasis')) {
            Schema::table('input_aspirasis', function (Blueprint $table) {
                $table->foreign('nis')
                    ->references('nis')
                    ->on('siswas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
    }

    public function down()
    {
        // Drop foreign keys
        try {
            Schema::table('aspirasis', function (Blueprint $table) {
                $table->dropForeign(['nis']);
            });
        } catch (\Exception $e) {
            // ignore
        }

        if (Schema::hasTable('input_aspirasis')) {
            try {
                Schema::table('input_aspirasis', function (Blueprint $table) {
                    $table->dropForeign(['nis']);
                });
            } catch (\Exception $e) {
                // ignore
            }
        }

        // Revert to BIGINT (best-effort fallback). Modify as needed to match original schema.
        DB::statement("ALTER TABLE `siswas` MODIFY `nis` BIGINT NOT NULL");
        DB::statement("ALTER TABLE `aspirasis` MODIFY `nis` BIGINT NOT NULL");
        if (Schema::hasTable('input_aspirasis')) {
            DB::statement("ALTER TABLE `input_aspirasis` MODIFY `nis` BIGINT NOT NULL");
        }

        // Recreate foreign key
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->foreign('nis')
                ->references('nis')
                ->on('siswas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        if (Schema::hasTable('input_aspirasis')) {
            Schema::table('input_aspirasis', function (Blueprint $table) {
                $table->foreign('nis')
                    ->references('nis')
                    ->on('siswas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
    }
}
