<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sumatif extends Model
{
    use HasFactory;

    protected $table = 'sumatif';
    protected $primaryKey = 'id_sumatif';
    protected $fillable = [
        'id_sumatif',
        'id_pengambilanKelas',
        'waktuMulai_sumatif',
        'waktuSelesai_sumatif',
        'nilai_sumatif',
    ];
    public $timestamps = false;


    public function pengambilanKelas(){
        return $this->hasMany(PengambilanKelas::class, 'id_pengambilanKelas', 'id_pengambilanKelas');
    }

    public function detail(){
        return $this->hasMany(DetailTesSumatif::class, 'id_sumatif', 'id_sumatif');
    }

    public function veryDetail(){
        $jawaban = DB::table('detail_tes_sumatif')
                        ->join('soalpilihanganda', 'detail_tes_sumatif.id_soalPilihanGanda', '=', 'soalpilihanganda.id_soalPilihanGanda')
                        ->join('pilihanjawaban', 'detail_tes_sumatif.id_pilihanJawaban', '=', 'pilihanjawaban.id_pilihanJawaban')
                        ->select('detail_tes_sumatif.no_soal','soalpilihanganda.soal', 'pilihanjawaban.noUrut_pilihan', 'pilihanjawaban.teks_pilihan')
                        ->where('detail_tes_sumatif.id_sumatif', '=', $this->id_sumatif)
                        ->orderBy('detail_tes_sumatif.no_soal')
                        ->get();
        return $jawaban;
    }
    

    private function selectSoal($indikator, $number){
        $numSoal = $this->id_sumatif + $indikator->id_indikator + $this->pengambilanKelas->id_pengambilanKelas + $number;
        $countSoal = count($indikator->soal);
        $numSoal %= $countSoal;
        $soal = $indikator->soal->slice($numSoal, 1);
        return $soal;
    }
    private function getIndikator(){
        $indikator = $this->pengambilanKelas->kelas->matakuliah->indikator;
        return $indikator;
    }

    private function getDurationlimit(){

        $settings = $this->pengambilanKelas->kelas->settingKelas();
        $indikator = $this->getIndikator()->count();
        $time  = $settings->waktu_per_soal_sumatif * $indikator;
        return $time;
    }

    private function getTimeLimit(){
        $time = date('Y-m-d H:i:s',strtotime($this->waktuMulai_sumatif.'+'.$this->getDurationlimit().' minutes'));
        return $time;
    }

    public function startTesSumatif(){
        if ($this->pengambilanKelas->status_pengambilanKelas == 1){
            throw new \Exception('kelas has not finished yet');
        }
        $settings = $this->pengambilanKelas->kelas->settingKelas();
        if (!$settings->sumatifIsAvailable()){
            throw new \Exception('sumatif is not available today');
        }
        $this->generateSoal();
        $this->waktuMulai_sumatif =  date("Y-m-d H:i:s");
        $this->save();
    }

    public function endTesSumatif(){
        $this->waktuSelesai_sumatif = date("Y-m-d H:i:s");
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
        
        $this->nilai_sumatif = $score *100 / $scoreMax; 
        $this->save();
        return $this;
    }
    
    
    private function isRunning(){
        if(($this->waktuMulai_sumatif)  and ( strtotime(date("Y-m-d H:i:s")) <  strtotime($this->getTimeLimit()))){
            return true;
        }
        return false;
    }

    public function getTimeRemaining(){
        return date("H:i:s",strtotime($this->getTimeLimit()) - strtotime((date("Y-m-d H:i:s"))));
    }

    private function generateSoal(){
        if (!$this->detail()->exists()){
            $settings = $this->pengambilanKelas->kelas->settingKelas();
            $indikators = $this->getIndikator();
            
            $lastNum = 0;
            $maxNum = $settings->soal_sumatif_per_indikator;
            DB::beginTransaction();
            try {
                foreach($indikators as $indikator){
                    for ($i = 1; $i <= $maxNum ; $i++) {
                        $lastNum +=1;
                        $soal = $this->selectSoal($indikator, $i)->first();
                        $detailTesSumatif = new DetailTesSumatif;
                        $detailTesSumatif->id_sumatif = $this->id_sumatif;
                        $detailTesSumatif->no_soal = $lastNum;
                        $detailTesSumatif->id_pilihanJawaban = $soal->id_soalPilihanGanda;
                        $detailTesSumatif->save();
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

            $idsoal = $this->detail->where('no_soal',$noSoal)->first()->id_soalPilihanGanda;
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
            throw new \Exception('this test has not been started or already finished');
        }
        $soal = $this->showSoal($noSoal);
        $jawaban = $soal->jawaban->where('noUrut_pilihan', '=', $noUrut_pilihan)->first();
        
        if(!$this->detail()->exists()){
            $lastNum = 0;
        }   
        else{
            $lastNum = $this->detail()->get()
            ->sortByDesc('no_soal')->first()
            ->nomorUrut_soal;
        }

        $detailTesSumatif = DetailTesSumatif::where("no_soal", $noSoal)
        ->where("id_sumatif", $this->id_sumatif)->first();
        $detailTesSumatif->id_pilihanJawaban = $jawaban->id_pilihanJawaban;
        $detailTesSumatif->save();
        return $detailTesSumatif;
    }
}




