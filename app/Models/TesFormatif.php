<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TesFormatif extends Model
{
    use HasFactory;
    protected $table = 'tesformatif';
    protected $primaryKey = 'id_tesFormatif';
    protected $fillable = [
        'id_tesFormatif',
        'id_subCpmkPengambilan',
        'pengulangan_tesFormatif',
        'waktuMulai_TesFormatif',
        'waktuSelesai_tesFormatif',
        'nilai_tesFormatif',
        'status_TesFormatif', // 1 = running , 2 = finished failed, 3 = finished passed
    ];
    public $timestamps = false;

    public function subcpmkPengambilan(){
        return $this->belongsTo(SubcpmkPengambilan::class, 'id_subCpmkPengambilan', 'id_subcpmkpengambilan');
    }

    public function detail(){
        return $this->hasMany(DetailTesFormatif::class, 'id_tesFormatif', 'id_tesFormatif');
    }

    public function veryDetail(){
        $jawaban = DB::table('detailTesFormatif')
                        ->join('soalpilihanganda', 'detailTesFormatif.id_soalPilihanGanda', '=', 'soalpilihanganda.id_soalPilihanGanda')
                        ->join('pilihanjawaban', 'detailTesFormatif.id_pilihanJawaban', '=', 'pilihanjawaban.id_pilihanJawaban')
                        ->select('detailTesFormatif.nomorUrut_soal','soalpilihanganda.soal', 'pilihanjawaban.noUrut_pilihan', 'pilihanjawaban.teks_pilihan')
                        ->where('detailTesFormatif.id_tesFormatif', '=', $this->id_tesFormatif)
                        ->orderBy('detailTesFormatif.nomorUrut_soal')
                        ->get();
        return $jawaban;
    }

    private function selectSoal($indikator, $number){
        $numSoal = $this->id_tesFormatif + $indikator->id_indikator + $this->pengulangan_tesFormatif + $number;
        $countSoal = count($indikator->soal);
        $numSoal %= $countSoal;
        $soal = $indikator->soal->slice($numSoal, 1);
        return $soal;
    }

    //return number of minute
    private function getDurationlimit(){

        $settings = $this->subcpmkPengambilan->settingKelas();
        $id_subcpmk  = $this->subcpmkPengambilan->id_subCPMK;
        $indikator = SubCpmk::find($id_subcpmk)->indikator->count();
        $time  = $settings->waktu_per_soal_formatif * $indikator;
        return $time;
    }

    private function getTimeLimit(){
        $time = date('Y-m-d H:i:s',strtotime($this->waktuMulai_TesFormatif.'+'.$this->getDurationlimit().' minutes'));
        return $time;
    }

    public function startTesFomatif(){
        if ($this->subcpmkPengambilan->status_subcpmkpengambilan == 1){
                throw new \Exception('unit/subcpmk has not finished yet');
        }
        $this->generateSoal();
        $this->waktuMulai_TesFormatif =  date("Y-m-d H:i:s");
        $this->save();
    }
    public function endTesFormatif(){
        $this->waktuSelesai_tesFormatif = date("Y-m-d H:i:s");
        $this->status_TesFormatif = 2;
        
        $detail = $this->detail()->get();

        $score = 0;
        $scoreMax = 0;
        $settings = $this->subcpmkPengambilan->settingKelas();
        $bobotIndex = $settings->getBobotArray();
        foreach ($detail as $item){
            $jawaban = 0;
            $bobot =0;
            try{
                //jawaban will return null if its empty and cause error
                $level = $item->jawaban->soal->indikator->level_indikator - 1;
                $bobot = $bobotIndex[$level];
                $jawaban= $item->jawaban->status_pilihan;
            }
            catch (\Exception $e)
            {
                $jawaban = 0;
                $level = $item->soal->indikator->level_indikator -1 ;
                $bobot = $bobotIndex[$level];
            }
            if($jawaban == 1){
                $score += $bobot;
            }
            $scoreMax += $bobot;
        }
        // dd($trueAnswer);
        
        $this->nilai_tesFormatif = $score *100 / $scoreMax; 
        $this->checkPassing();
        $this->save();
        return $this;
    }

    private function checkPassing(){
        $settings = $this->subcpmkPengambilan->settingKelas();
        if ($this->nilai_tesFormatif >= $settings->KKM){
            $this->status_TesFormatif = 3;
            $this->save();
        }
        else if($this->pengulangan_tesFormatif >= $settings->batas_pengulangan_remidi){
            // there is a possibility that previous attempts is passed
            $passed = $this->subcpmkPengambilan->tesFormatif->where('status_TesFormatif',3);
            if (!$passed){
                $sub = $this->subcpmkPengambilan;
                $sub->status_subcpmkpengambilan = 3;
                $sub->save();
            }
        }
    }


    private function isRunning(){
        if(($this->waktuMulai_TesFormatif) and ($this -> status_TesFormatif == 1) and ( strtotime(date("Y-m-d H:i:s")) <  strtotime($this->getTimeLimit()))){
            return true;
        }
        return false;
    }

    public function getTimeRemaining(){
        return date("H:i:s",strtotime($this->getTimeLimit()) - strtotime((date("Y-m-d H:i:s"))));
    }

    private function generateSoal(){
        if (!$this->detail()->exists()){
            $settings = $this->subcpmkPengambilan->settingKelas();
            $id_subcpmk  = $this->subcpmkPengambilan->id_subCPMK;
            $indikators = SubCpmk::find($id_subcpmk)->indikator
            ->sortBy("nomorUrut_indikator");
            
            $lastNum = 0;
            $maxNum = $settings->soal_formatif_per_indikator;
            DB::beginTransaction();
            try {
                foreach($indikators as $indikator){
                    for ($i = 1; $i <= $maxNum ; $i++) {
                        $lastNum +=1;
                        $soal = $this->selectSoal($indikator, $i)->first();
                        $detailTesFormatif = new DetailTesFormatif;
                        $detailTesFormatif->id_tesFormatif = $this->id_tesFormatif;
                        $detailTesFormatif->nomorUrut_soal = $lastNum;
                        $detailTesFormatif->id_soalPilihanGanda = $soal->id_soalPilihanGanda;
                        $detailTesFormatif->save();
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }
        else{
            throw new \Exception('soal has already generated');
        }
    }

    public function showSoal($noSoal){
        try{

            $idsoal = $this->detail->where('nomorUrut_soal',$noSoal)->first()->id_soalPilihanGanda;
            $soal = Soalpilihanganda::find($idsoal);
            $soal->jawaban;
            return $soal;
        }
        catch (\Exception $e)
        {
            throw new \Exception('soal does not exist');
        }
    }



    public function saveJawaban($noUrut_pilihan, $noSoal){
        if (! $this->isRunning()){
            throw new \Exception('this attempted has not been started or already finished');
        }
        $soal = $this->showSoal($noSoal);
        $jawaban = $soal->jawaban->where('noUrut_pilihan', '=', $noUrut_pilihan)->first();
        
        if(!$this->detail()->exists()){
            $lastNum = 0;
        }   
        else{
            $lastNum = $this->detail()->get()
            ->sortByDesc('nomorUrut_soal')->first()
            ->nomorUrut_soal;
        }

        $detailTesFormatif = DetailTesFormatif::where("nomorUrut_soal", $noSoal)
        ->where("id_tesFormatif", $this->id_tesFormatif)->first();
        $detailTesFormatif->id_pilihanJawaban = $jawaban->id_pilihanJawaban;
        $detailTesFormatif->save();
        return $detailTesFormatif;
    }
}
