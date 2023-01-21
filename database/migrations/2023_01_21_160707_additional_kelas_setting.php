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
        Schema::table('setting_kelas', function (Blueprint $table) {
            //
            $table->integer("soal_formatif_per_indikator")->default(1);
            $table->integer("soal_sumatif_per_indikator")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_kelas', function (Blueprint $table) {
            //
        });
    }
};
