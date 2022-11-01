<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\PengambilanKelas;

class PengambilanKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kelases = Kelas::all();
        foreach ($kelases as $kelas)
        {
            $siswas = Siswa::inRandomOrder()->limit(rand(10,20))->get();
            foreach ($siswas as $siswa)
            {
                $pKelas = new PengambilanKelas;
                $pKelas->id_siswa = $siswa->id_siswa;
                $pKelas->id_kelas = $kelas->id_kelas;
                $pKelas->status_pengambilanKelas = 1;
                $pKelas->save();
            }
        }
    }
}
