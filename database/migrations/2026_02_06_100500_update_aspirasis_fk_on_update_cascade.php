<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAspirasisFkOnUpdateCascade extends Migration
{
    public function up()
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropForeign(['nis']);
            $table->foreign('nis')
                ->references('nis')
                ->on('siswas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropForeign(['nis']);
            $table->foreign('nis')
                ->references('nis')
                ->on('siswas')
                ->onDelete('cascade');
        });
    }
}
