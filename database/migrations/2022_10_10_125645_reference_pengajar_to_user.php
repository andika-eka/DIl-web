<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::table('pengajar', function (Blueprint $table) {
            //
            $table->bigInteger('id_pengajar')->length(20)->unsigned()->autoIncrement(false)->change();
            $table->foreign("id_pengajar")->references('id')->on('users')->onDelete('cascade');
        });
        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajar', function (Blueprint $table) {
            //
            $table->bigInteger('id_pengajar')->length(20)->unsigned()->autoIncrement()->change();
            $table->dropForeign("id_pengajar");
        });
    }
};
