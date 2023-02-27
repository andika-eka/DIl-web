<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'identitas_siswa',
        'email_siswa',
        'nama_siswa',
        'jenisKelamin_siswa',
        'tanggalLahir_siswa',
        'pathFileFoto_siswa',
        'account_active',
    ];

    protected $table = "siswa";
    protected $primaryKey = "id_siswa";

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,  "id_siswa", "id");
    }
    public function kelas()
    {
        return $this->belongsToMany(kelas::class, "pengambilankelas", "id_siswa", "id_kelas");
    }

    public function approvedKelas(){
        $kelas = DB::table('kelas')
                        ->join('pengambilankelas', 'kelas.id_kelas', '=', 'pengambilankelas.id_kelas')
                        ->join('siswa', 'pengambilankelas.id_siswa', '=', 'siswa.id_siswa')
                        ->select('kelas.*', )
                        ->where([
                            ['pengambilankelas.id_siswa', '=', $this->id_siswa],
                            ['pengambilankelas.status_pengambilanKelas', '=', 1],
                        ])
                        ->get();
        return $kelas;
    }
    /**
     *
     * true if siswa is enrolled in the kelas
     * 
     * @param integer $id_kelas
     * @return boolean 
     */
    private function isEnrolledInKelas($id_kelas){
        $kelas = Kelas::find($id_kelas);
        return $kelas->siswa->contains($this->id_siswa);
    }

    /**
     *
     * get all sub cpmk in kelas
     * 
     * @param integer $id_kelas
     * @return App\Models\Subcpmk;
     */
    public function subcmpkbyKelas($id_kelas){
        if($this->isEnrolledInKelas($id_kelas)){
            $kelas = Kelas::find($id_kelas);
            $subcpmk = $kelas->matakuliah->subcpmk->sortBy('nomorUrut_subCpmk');
            
            return $subcpmk;
        }
        else{
            throw new \Exception('Siswa is not enrolled');
        }
    }

    /**
     *
     * get completed subcpmk in kelas
     * 
     * @param integer $id_kelas
     * @return App\Models\Subcpmk;
     */
    public function getProgressSubCpmk($id_kelas){
        if($this->isEnrolledInKelas($id_kelas)){
            if (!$this->isOnProgres($id_kelas)){
                $this->startKelas($id_kelas);
            }
            $subcpmk = DB::table('subcpmk')
                        ->join('subcpmkpengambilan', 'subcpmk.id_subCpmk', '=', 'subcpmkpengambilan.id_subCPMK')
                        ->join('pengambilankelas', 'subcpmkpengambilan.id_pengambilanKelas', '=', 'pengambilankelas.id_pengambilanKelas')
                        ->select('subcpmk.*', 'pengambilankelas.*', 'subcpmkpengambilan.*')
                        ->where([
                            ['pengambilankelas.id_siswa', '=', $this->id_siswa],
                            ['pengambilankelas.id_kelas', '=',  $id_kelas],
                            ['subcpmkpengambilan.status_subcpmkpengambilan', '=', 2],
                        ])
                        ->orderBy("subcpmk.nomorUrut_subCpmk")
                        ->get();
            return $subcpmk;
        }
        else{
            throw new \Exception('Siswa is not enrolled');
        }
    }

    /**
     *
     * get current subcpmk in kelas
     * 
     * @param integer $id_kelas
     * @return App\Models\Subcpmk;
     */
    public function getCurrentSubCpmk($id_kelas){
        if($this->isEnrolledInKelas($id_kelas)){
            if (!$this->isOnProgres($id_kelas)){
                $this->startKelas($id_kelas);
            }
            $subcpmk = DB::table('subcpmk')
                        ->join('subcpmkpengambilan', 'subcpmk.id_subCpmk', '=', 'subcpmkpengambilan.id_subCPMK')
                        ->join('pengambilankelas', 'subcpmkpengambilan.id_pengambilanKelas', '=', 'pengambilankelas.id_pengambilanKelas')
                        ->select('subcpmk.*', 'pengambilankelas.*', 'subcpmkpengambilan.*')
                        ->where([
                            ['pengambilankelas.id_siswa', '=', $this->id_siswa],
                            ['pengambilankelas.id_kelas', '=',  $id_kelas],
                        ])
                        ->orderByDesc("subcpmkpengambilan.waktuMulai_Pengambilan")
                        ->first();
            return $subcpmk;
        }
        else{
            throw new \Exception('Siswa is not enrolled');
        }
    }
    /**
     * start a learning session for the given siswa
     * get the first subcmpk by nomorUrut_subCpmk
     * create a new SubcpmkPengambilan
     *
     * @param integer $id_kelas
     */
    private function startKelas($id_kelas){
        $kelas = Kelas::find($id_kelas);
        $subcpmk = $kelas->matakuliah->subcpmk->sortBy("nomorUrut_subCpmk")->first();
        $pengambilankelas = PengambilanKelas::where([
            ['id_siswa', '=', $this->id_siswa],
            ['id_kelas', '=', $id_kelas]
        ])->first();
        $subPengambilan = new SubcpmkPengambilan;
        $subPengambilan->id_pengambilanKelas = $pengambilankelas->id_pengambilanKelas;
        $subPengambilan->id_subCPMK = $subcpmk->id_subCpmk;
        $subPengambilan->waktuMulai_Pengambilan = date("Y-m-d H:i:s");
        $subPengambilan->status_subcpmkpengambilan = 1;
        $subPengambilan->save();
    }

    public function isOnProgres($id_kelas){
        if($this->isEnrolledInKelas($id_kelas)){
            $subcpmk = DB::table('subcpmkpengambilan')
            ->join('pengambilankelas', 'subcpmkpengambilan.id_pengambilanKelas', '=', 'pengambilankelas.id_pengambilanKelas')
            ->select('subcpmkpengambilan.*')
            ->where([
                ['pengambilankelas.id_siswa', '=', $this->id_siswa],
                ['pengambilankelas.id_kelas', '=',  $id_kelas]])
                ->first();
                if ($subcpmk){
                    return true;
                }
                else{
                    return false;
                }
            }
        else{
            throw new \Exception('Siswa is not enrolled');
        }
    }
            
    
    
    /**
     * get all materi
     * in current subcpmk in kelas
     * 
     * @param integer $id_kelas
     * @return App\Models\Subcpmk;
     */
    public function getCurrentMateriList($id_kelas){
        $subcpmk_id = $this->getCurrentSubCpmk($id_kelas)->id_subCpmk;
        if($subcpmk_id){
            $subcpmk = SubCpmk::with('indikator.materi')->find($subcpmk_id);
            return  $subcpmk;
        }
        else{
            throw new \Exception('Siswa is not enrolled');
        }
    }

    /**
     *
     * start materi progress 
     * in current subcpmk in kelas
     * 
     * put materi_id in current_materi_id of current subcpmk
     * 
     * @param integer $id_kelas
     */
    private function startMateri($id_kelas){
        $materiList = $this->GetCurrentMateriList($id_kelas)->indikator;
        $indikatorfirst = $materiList->sortBy('nomorUrut_indikator')->first();
        $materifirst = $indikatorfirst->materi->sortBy('nomorUrut_materi')->first();
        $materiId = $materifirst->id_materi;
        $subcpmkPengambilan_id = $this->getCurrentSubCpmk($id_kelas)->id_subcpmkpengambilan;
        $subcpmkPengambilan = SubcpmkPengambilan::find($subcpmkPengambilan_id);
        $subcpmkPengambilan->current_materi_id = $materiId;
        $subcpmkPengambilan->current_materi_start_time = date("Y-m-d H:i:s");
        $subcpmkPengambilan->save();
    }

    /**
     *
     * get detail from materi_id in current_materi_id of current subcpmk
     * 
     * start a new materi if current_materi_id in null
     * 
     * @param integer $id_kelas
     * @return App\Models\Materi;
     */

    private function checkSubStatus($status){
        if ($status == 2){
            throw new \Exception('siswa has to go to test');
        }
        if ($status == 3){
            throw new \Exception('class is locked');
        }
    }
    public function getCurrentMateri($id_kelas){
        
        $subcpmk = $this->getCurrentSubCpmk($id_kelas);
        if($subcpmk){
                $this->checkSubStatus($subcpmk->status_subcpmkpengambilan);
                if (!$subcpmk->current_materi_id){
                    $this-> startMateri($id_kelas);
                }
                $subcpmk = $this->getCurrentSubCpmk($id_kelas);
                $materi = Materi::find($subcpmk->current_materi_id);
                return $materi;
            }
        else{
            throw new \Exception('Siswa is not enrolled');
        }
        
    }


    public function nextMateri($id_kelas) { //might need some refactoring
        $subcpmk = $this-> getCurrentSubCpmk($id_kelas);
        if($subcpmk){
            $currentMateri = $this->getCurrentMateri($id_kelas);
            if($currentMateri->minimum_time){
                $minimumTime = strtotime('+'.$currentMateri->minimum_time.' minutes',strtotime($subcpmk->current_materi_start_time));
                if (strtotime(date("Y-m-d H:i:s")) < $minimumTime){
                    throw new \Exception('minimum time not reached');
                    return false;
                }
            }
            $indikatorMateri = $currentMateri->indikator->materi;
            $lastMateri = $indikatorMateri->sortByDesc("nomorUrut_materi")->first();

            $subcpmkPengambilan_id =  $subcpmk->id_subcpmkpengambilan;
            $subcpmkPengambilan = SubcpmkPengambilan::find($subcpmkPengambilan_id);
            
            if($currentMateri->nomorUrut_materi == $lastMateri->nomorUrut_materi){
                $subCpmkIndikator = SubCpmk::find($subcpmk->id_subCpmk)->indikator;
                $lastIndikator = $subCpmkIndikator->sortByDesc("nomorUrut_indikator")->first();
                
                if($currentMateri->indikator->nomorUrut_indikator == $lastIndikator->nomorUrut_indikator){
                    //finnish
                    $subcpmkPengambilan->current_materi_id = NULL;
                    $subcpmkPengambilan->current_materi_start_time = NUll;
                    $subcpmkPengambilan->status_subcpmkpengambilan = 2;
                    $subcpmkPengambilan->save();
                    return false;
                }
                else{
                    $nextIndikator = $subCpmkIndikator->where("nomorUrut_indikator", ">",$currentMateri->indikator->nomorUrut_indikator)->first();
                    // dd($nextIndikator);
                    $nextMateri = $nextIndikator->materi->sortBy("nomorUrut_materi")->first();
                    $materiId = $nextMateri->id_materi;
                    $subcpmkPengambilan->current_materi_id = $materiId;
                    $subcpmkPengambilan->current_materi_start_time = date("Y-m-d H:i:s");
                    $subcpmkPengambilan->save();
                }   
            }
            else{
                $nextMateri =$indikatorMateri->where("nomorUrut_materi", $currentMateri->nomorUrut_materi + 1 )->first();
                $materiId = $nextMateri->id_materi;
                $subcpmkPengambilan->current_materi_id = $materiId;
                $subcpmkPengambilan->current_materi_start_time = date("Y-m-d H:i:s");
                $subcpmkPengambilan->save();
            }
            return true;
        }
        else{
            throw new \Exception('Siswa is not enrolled');
        }

    }

    public function nextSubcpmk($id_kelas){
        $currentSubcpmk = $this->getCurrentSubCpmk($id_kelas);
        $testFormatif = TesFormatif::where("id_subCpmkPengambilan",$currentSubcpmk->id_subcpmkpengambilan)
                        ->where("status_TesFormatif", 3)->first();
        if ($testFormatif){
            $kelas = Kelas::find($id_kelas);
            $subcpmk = $kelas->matakuliah->subcpmk
                ->where("nomorUrut_subCpmk", '>', $currentSubcpmk->nomorUrut_subCpmk)
                ->sortBy("nomorUrut_subCpmk")->first();
            if(!$subcpmk){
                $pengambilankelas = PengambilanKelas::where([
                    ['id_siswa', '=', $this->id_siswa],
                    ['id_kelas', '=', $id_kelas]
                ])->first();
                $pengambilankelas->status_pengambilanKelas = 3;
                return false;
            }
            $pengambilankelas = PengambilanKelas::where([
                ['id_siswa', '=', $this->id_siswa],
                ['id_kelas', '=', $id_kelas]
            ])->first();
            $subPengambilan = new SubcpmkPengambilan;
            $subPengambilan->id_pengambilanKelas = $pengambilankelas->id_pengambilanKelas;
            $subPengambilan->id_subCPMK = $subcpmk->id_subCpmk;
            $subPengambilan->waktuMulai_Pengambilan = date("Y-m-d H:i:s");
            $subPengambilan->status_subcpmkpengambilan = 1;
            $subPengambilan->save();
            return true;
        }
        else{
            throw new \Exception('previuos tesformatif has not finished yet');
        }
        
    }
    
    public function getTesSumatif($id_kelas){
        $pengambilanKelas = PengambilanKelas::where('id_kelas',$id_kelas)
        ->where('id_siswa',$this->id_siswa)->first();
        return $pengambilanKelas->sumatif;
    }
    
    public function getTesformatifHistory($id_kelas){
        $pengambilanKelas = PengambilanKelas::where('id_kelas',$id_kelas)
        ->where('id_siswa',$this->id_siswa)->first();
        $testFormatif = SubcpmkPengambilan::with('tesFormatif')->where('id_pengambilanKelas',$pengambilanKelas->id_pengambilanKelas)->get();
        return $testFormatif;
    }
    
    public function fellowFailed($id_kelas){
        $currentSubcpmk = $this->getCurrentSubCpmk($id_kelas);
        $subcpmkPengambilan = SubcpmkPengambilan::find($currentSubcpmk->id_subcpmkpengambilan);
        $lastTest = $subcpmkPengambilan->completedTesFormatif()->sortByDesc("pengulangan_tesFormatif")->first();
        $settings = $subcpmkPengambilan->settingKelas();
        if(!$lastTest){
            throw new \Exception('only acceesable by failed student');
        }
        if(($settings->canStartFormatif($lastTest->waktuSelesai_tesFormatif)) and $currentSubcpmk->status_subcpmkpengambilan != 3){
            
        }
            $siswa = DB::table('siswa')
                    ->join('pengambilankelas', 'siswa.id_siswa', '=', 'pengambilankelas.id_siswa')
                    ->join('subcpmkpengambilan', 'pengambilankelas.id_pengambilanKelas', '=', 'subcpmkpengambilan.id_pengambilanKelas')
                    ->join('tesformatif', 'subcpmkpengambilan.id_subcpmkpengambilan', '=', 'tesformatif.id_subcpmkpengambilan')
                    ->select('siswa.*', 'tesformatif.*', DB::raw('max(tesformatif.nilai_tesFormatif) as max_nilai'))
                    ->groupBy('siswa.id_siswa')
                    ->where('pengambilankelas.id_kelas','=', $id_kelas)
                    ->where('subcpmkpengambilan.id_subCPMK', '=',  $currentSubcpmk->id_subCpmk)
                    ->where('tesformatif.status_TesFormatif', '=', 2)
                    ->get();

            return $siswa;
    }

    public function topSiswa($id_kelas, $number){
        $currentSubcpmk = $this->getCurrentSubCpmk($id_kelas);
        if ($currentSubcpmk->status_subcpmkpengambilan != 3) {
            throw new \Exception('only acceesable by locked student');
        }
        $siswa = DB::table('siswa')
                ->join('pengambilankelas', 'siswa.id_siswa', '=', 'pengambilankelas.id_siswa')
                ->join('subcpmkpengambilan', 'pengambilankelas.id_pengambilanKelas', '=', 'subcpmkpengambilan.id_pengambilanKelas')
                ->join('tesformatif', 'subcpmkpengambilan.id_subcpmkpengambilan', '=', 'tesformatif.id_subcpmkpengambilan')
                ->select('siswa.*', 'tesformatif.*', DB::raw('max(tesformatif.nilai_tesFormatif) as max_nilai'))
                ->groupBy('siswa.id_siswa')
                ->where('pengambilankelas.id_kelas','=', $id_kelas)
                ->where('subcpmkpengambilan.id_subCPMK', '=',  $currentSubcpmk->id_subCpmk)
                ->orderByDesc('max_nilai')
                ->limit($number)
                ->get();
        return $siswa;
    }




}
