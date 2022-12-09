<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\PengambilanKelas;

class ApplyKelasSeeder extends Seeder
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
            $effectedkelas = rand(1,3);
            if ($effectedkelas == 2){
                $siswas = Siswa::inRandomOrder()->limit(rand(5,10))->get();
                foreach ($siswas as $siswa)
                {
                    try{

                        $pKelas = new PengambilanKelas;
                        $pKelas->id_siswa = $siswa->id_siswa;
                        $pKelas->id_kelas = $kelas->id_kelas;
                        $pKelas->status_pengambilanKelas = 2;
                        $pKelas->save();
                    }
                    catch (\Exception $e)
                    {
                        continue;
                    }
                }
            }
        }
    }
}
