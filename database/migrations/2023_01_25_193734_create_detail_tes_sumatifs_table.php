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
        Schema::create('detail_tes_sumatif', function (Blueprint $table) {
            $table->id('id_detail_sumatif');
            $table->unsignedBigInteger('id_sumatif');
            $table->integer('no_soal');
            $table->unsignedBigInteger('id_soalPilihanGanda');
            $table->unsignedBigInteger('id_pilihanJawaban')->nullable();
            $table->foreign('id_sumatif')->references('id_sumatif')->on('sumatif')->onDelete('cascade');
            $table->foreign('id_soalPilihanGanda')->references('id_soalPilihanGanda')->on('soalpilihanganda')->onDelete('cascade');
            $table->foreign('id_pilihanJawaban')->references('id_pilihanJawaban')->on('pilihanjawaban')->onDelete('cascade');
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
        Schema::dropIfExists('detail_tes_sumatifs');
    }
};
