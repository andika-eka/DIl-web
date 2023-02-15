<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\PengambilanKelas;
use App\Models\Sumatif;


class SumatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(Kelas::all() as $kelas){
            if (rand(1,3)==1){
                $pengambilanKelas = pengambilanKelas::where('id_kelas', $kelas)->get();
                foreach($pengambilanKelas as $pengambilan){
                    $pengambilan->status_pengambilanKelas = 3;
                    $pengambilan->save();

                    $sumatif = new Sumatif;
                    $sumatif->id_pengambilanKelas = $pengambilan->id_pengambilanKelas;
                    $sumatif->waktuMulai_sumatif =  date("Y-m-d H:i:s");
                    $sumatif->waktuSelesai_sumatif = date('Y-m-d H:i:s',strtotime($sumatif->waktuMulai_sumatif.'+'.rand(10,30).' minutes'));
                    $sumatif->nilai_sumatif = rand(30,95);
                    $sumatif->save();
                }

                
            }
        }
    }
}
