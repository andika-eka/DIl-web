<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubcpmkPengambilan;
use App\Models\TesFormatif;

class FormatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $subcpmkPengambilan = SubcpmkPengambilan::all();
        foreach ($subcpmkPengambilan as $subcpmk){
            if ($subcpmk->status_subcpmkpengambilan == 1){
                continue;
            }
            if ($subcpmk->status_subcpmkpengambilan == 2){
                for ($i=0; $i < rand(1,3); $i++){
                    $tes = new TesFormatif;
                    $tes->id_subCpmkPengambilan = $subcpmk->id_subcpmkpengambilan;
                    $tes->pengulangan_tesFormatif = $i;
                    $tes->waktuMulai_TesFormatif = date("Y-m-d H:i:s");
                    $tes->waktuSelesai_tesFormatif =date('Y-m-d H:i:s',strtotime($tes->waktuMulai_TesFormatif.'+'.rand(10,30).' minutes'));
                    $tes->nilai_tesFormatif = rand(75,95); 
                    $tes->status_TesFormatif = 3;
                    $tes->save();
                }
            }
            if ($subcpmk->status_subcpmkpengambilan == 3){
                for ($i=0; $i < 3; $i++){
                    $tes = new TesFormatif;
                    $tes->id_subCpmkPengambilan = $subcpmk->id_subcpmkpengambilan;
                    $tes->pengulangan_tesFormatif = $i;
                    $tes->waktuMulai_TesFormatif = date("Y-m-d H:i:s");
                    $tes->waktuSelesai_tesFormatif =date('Y-m-d H:i:s',strtotime($tes->waktuMulai_TesFormatif.'+'.rand(10,30).' minutes'));
                    $tes->nilai_tesFormatif = rand(10,70); 
                    $tes->status_TesFormatif = 2;
                    $tes->save();
                }
            }
        }
    }
}
