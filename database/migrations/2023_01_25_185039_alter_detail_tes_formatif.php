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
            //
            if (Schema::hasColumn('detailtesformatif', 'id_pilihanJawaban'))
            {
                Schema::table('detailtesformatif', function (Blueprint $table)
                {
                    $table->dropForeign('detailtesformatif_ibfk_2');
                    $table->dropColumn('id_pilihanJawaban');
                });
            }
            $table->unsignedBigInteger('id_pilihanJawaban')->nullable();
            $table->foreign('id_pilihanJawaban')->references('id_pilihanJawaban')->on('pilihanjawaban')->onDelete('cascade');
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
            //
        });
    }
};
