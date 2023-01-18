<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
        'status_TesFormatif',
    ];
    public $timestamps = false;

    public function subcpmkPengambilan(){
        return $this->belongsTo(SubcpmkPengambilan::class, 'id_subCpmkPengambilan', 'id_subcpmkpengambilan');
    }

    public function detail(){
        return $this->hasMany(DetailTesFormatif::class, 'id_tesFormatif', 'id_tesFormatif');
    }

    private function selectSoal($indikator){
        $numSoal = $this->id_tesFormatif + $indikator->id_indikator + $this->pengulangan_tesFormatif;
        $countSoal = count($indikator->soal);
        $numSoal %= $countSoal;
        $soal = $indikator->soal->slice($numSoal, 1);
        return $soal;
    }

    //return number of minute
    private function getDurationlimit(){
        $id_subcpmk  = $this->subcpmkPengambilan->id_subCPMK;
        $time = SubCpmk::find($id_subcpmk)->indikator->count();
        return $time;
    }

    private function getTimeLimit(){
        $time = date('Y-m-d H:i:s',strtotime($this->waktuMulai_TesFormatif.'+'.$this->getDurationlimit().' minutes'));
        return $time;
    }

    public function startTesFomatif(){
        $this->generateSoal();
        $this->waktuMulai_TesFormatif =  date("Y-m-d H:i:s");
        $this->save();
    }
    public function endTesFormatif(){
        $this->waktuSelesai_tesFormatif = date("Y-m-d H:i:s");
        $this->status_TesFormatif = 2;
        
        $detail = $this->detail();
        $trueAnswer = 0;
        foreach ($detail as $item){
            if($item->jawaban->status_pilihan == 1){
                $trueAnswer++;
            }
        }
        
        $indikator = $this->subcpmkPengambilan->subCmpk->indikator->count();
        $this->nilai_tesFormatif = $trueAnswer *100 / $indikator; 
        $this->save();
        return $this;
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
            $id_subcpmk  = $this->subcpmkPengambilan->id_subCPMK;
            $indikators = SubCpmk::find($id_subcpmk)->indikator
            ->sortBy("nomorUrut_indikator");
            
            $lastNum = 0;
            foreach($indikators as $indikator){
                $lastNum +=1;
                $soal = $this->selectSoal($indikator)->first();
                $detailTesFormatif = new DetailTesFormatif;
                $detailTesFormatif->id_tesFormatif = $this->id_tesFormatif;
                $detailTesFormatif->nomorUrut_soal = $lastNum;
                $detailTesFormatif->id_soalPilihanGanda = $soal->id_soalPilihanGanda;
                $detailTesFormatif->save();
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
