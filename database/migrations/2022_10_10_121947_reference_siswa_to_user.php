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
        Schema::table('siswa', function (Blueprint $table) {
            //
            $table->bigInteger('id_siswa')->lenght(20)->unsigned()->autoIncrement(false)->change();
            $table->foreign("id_siswa")->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
            $table->bigInteger('id_siswa')->lenght(20)->unsigned()->autoIncrement()->change();
            $table->dropForegn("id_siswa");
        });
    }
};
