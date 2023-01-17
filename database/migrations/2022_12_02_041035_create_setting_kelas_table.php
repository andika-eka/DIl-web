<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_settting_kelas');
            $table->date("Mulai")->default(DB::raw('NOW()'));
            $table->date("Berakhir")->nullable();
            $table->integer("bobotC1")->default(15);
            $table->integer("bobotC2")->default(15);
            $table->integer("bobotC3")->default(15);
            $table->integer("bobotC4")->default(15);
            $table->integer("bobotC5")->default(15);
            $table->integer("bobotC6")->default(25);
            $table->integer("KKM")->default(80);
            $table->integer("waktu_tunggu_formatif")->default(0);
            $table->dateTime("tgl_sumatif")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_kelas');
    }
};
