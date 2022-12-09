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
        Schema::table('subcpmkpengambilan', function (Blueprint $table) {
            //
            $table->bigInteger("current_materi_id")->unsigned()->nullable();
            $table->dateTime("current_materi_start_time")->nullable();
            $table->foreign("current_materi_id")->references("id_materi")->on("materi")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subcpmkpengambilan', function (Blueprint $table) {
            //
        });
    }
};
