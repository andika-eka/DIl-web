<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Kelas;
use App\Models\MataKuliah;


class MatkulWithKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) 
        {
            $mataKuliah = new MataKuliah;
            $mataKuliah->kode_mataKuliah = $faker->bothify('???#####');
            $mataKuliah->nama_mataKuliah = $faker->bs();
            $mataKuliah->cpmk = $faker->text(rand(150,300));
            $mataKuliah->save();
            for($j=0; $j<rand(1,8); $j++)
            {
                $kelas = new Kelas;
                $kelas->id_matakuliah = $mataKuliah->id_matakuliah;
                $kelas->tahun_kelas = $faker->year();
                $kelas->semester_kelas = rand(1,8);
                $kelas->nama_kelas = $faker->bothify('???#');
                $kelas->tanggalBuat_kelas = $faker->date();
                $kelas->tanggalMulai_kelas = $faker->date();
                $kelas->tanggalSelesai_kelas = $faker->date();
                $kelas->status_kelas = rand(1,3);
                $kelas->jenis_kelas = 1;
                $kelas->save();
            }
        }
    }
}
