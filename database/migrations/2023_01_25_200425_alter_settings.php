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
            $table->integer("waktu_per_soal_formatif")->default(2);
            $table->integer("waktu_per_soal_sumatif")->default(2);
            $table->integer("batas_pengulangan_remidi")->default(3);

            if (Schema::hasColumn('setting_kelas', 'Mulai'))
            {
                Schema::table('setting_kelas', function (Blueprint $table)
                {
                    $table->dropColumn('Mulai');
                });
            }if (Schema::hasColumn('setting_kelas', 'Berakhir'))
            {
                Schema::table('setting_kelas', function (Blueprint $table)
                {
                    $table->dropColumn('Berakhir');
                });
            }
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
