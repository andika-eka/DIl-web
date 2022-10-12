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
            $table->string("identitas_siswa",15)->nullable()->unique()->change();
            $table->string("email_siswa",50)->nullable()->unique()->change();
            $table->string("nama_siswa",50)->nullable()->change();
            $table->smallInteger("jenisKelamin_siswa")->lenght(1)->nullable()->change();
            $table->date("tanggalLahir_siswa")->nullable()->change();
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
        Schema::table('siswa', function (Blueprint $table) {
            //
            $table->string("identitas_siswa",15)->unique()->change();
            $table->string("email_siswa",50)->unique()->change();
            $table->string("nama_siswa",50)->change();
            $table->smallInteger("jenisKelamin_siswa")->lenght(1)->change();
            $table->date("tanggalLahir_siswa")->change();
            $table->dropcColumn('account_active');

        });
    }
};
