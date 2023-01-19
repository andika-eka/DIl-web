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
        Schema::disableForeignKeyConstraints();
        Schema::table('detailtesformatif', function (Blueprint $table) {
            $table->text('alasanJawaban')->nullable()->change();
            $table->text('id_pilihanJawaban')->nullable()->change();
            $table->unsignedBigInteger('id_soalPilihanGanda');
            $table->foreign("id_soalPilihanGanda")->references("id_soalPilihanGanda")->on("soalpilihanganda")->onDelete("cascade");
        });
        Schema::enableForeignKeyConstraints();
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detailtesformatif', function (Blueprint $table) {
            $table->text('alasanJawaban')->change();
            //
        });
    }
};
