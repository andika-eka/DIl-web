<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * note:
     * https://stackoverflow.com/questions/45591455/change-column-type-to-tinyinteger
     * DBAL doesnt support tiny integer
     * @return void
     */
    public function up()
    {
        Schema::table('pengajar', function (Blueprint $table) {
            //
            $table->string("identitas_pengajar",20)->nullable()->unique()->change();
            $table->string("email_pengajar",50)->nullable()->unique()->change();
            $table->string("nama_pengajar",50)->nullable()->change();
            $table->smallInteger("jenisKelamin_Pengajar")->lenght(1)->nullable()->change();
            $table->date("tanggalLahir_Pengajar")->nullable()->change();
            $table->boolean('account_active')->default(false);
        }); 
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
            $table->string("identitas_pengajar",20)->unique()->change();
            $table->string("email_pengajar",50)->unique()->change();
            $table->string("nama_pengajar",50)->change();
            $table->smallInteger("jenisKelamin_Pengajar")->lenght(1)->change();
            $table->date("tanggalLahir_Pengajar")->change();
            $table->dropcColumn('account_active');
        });
    }
};
