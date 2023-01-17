<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubcpmkPengambilan;
use App\Models\PengambilanKelas;
use DateTime;
// use DatePeriod;
use DateInterval;
class SubcpmkPengamBilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pengambilanKelas = PengambilanKelas::all();
        foreach($pengambilanKelas as $kelas){
            $subcpmk = $kelas->kelas->matakuliah->subcpmk;
            $length = $subcpmk->count();
            $startDate = date("d.m.Y", strtotime("-".$length."Months"));
            $startDateTime = DateTime::createFromFormat('d.m.Y', $startDate);
            $current = rand(0,$length);
            $count = 1;
            // echo $startDateTime->format('Y-m-d H:i:s');;
            $isStarted = rand(1,3);
            if ($isStarted != 2){
                $isFinished = rand(1,2);
                foreach($subcpmk as $sub){
                    $subpengambilan = new SubcpmkPengambilan; 
                    $subpengambilan->id_pengambilanKelas = $kelas->id_pengambilanKelas;
                    $subpengambilan->id_subCPMK = $sub->id_subCpmk;
                    $subpengambilan->waktuMulai_Pengambilan = $startDateTime;
                    if ($isFinished ==1){
                        if ($count == $current){
                            $subpengambilan->waktuSelesai_Pengambilan= $startDateTime;
                            $subpengambilan->status_subcpmkpengambilan = 1;
                            $subpengambilan->save();
                            break;
                        }
                    }
                    $interval = rand(10,35);
                    $startDateTime->add(new DateInterval('P'.$interval.'D'));
                    $subpengambilan->waktuSelesai_Pengambilan = $startDateTime;
                    $subpengambilan->status_subcpmkpengambilan = 2;
                    $subpengambilan->save();
                    $count++;
                }
            }
        }
        
    }
}
