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
    public function getCurrentMateri($id_kelas){
        $subcpmk = $this->getCurrentSubCpmk($id_kelas);
    
        if($subcpmk->status_subcpmkpengambilan == 1){
            if($subcpmk){
                if (!$subcpmk->current_materi_id){
                    $this-> startMateri($id_kelas);
                }
                $materi = Materi::find($subcpmk->current_materi_id);
                return $materi;
            }
            else{
                throw new \Exception('Siswa is not enrolled');
            }
        }
        else{
            throw new \Exception('Siswa has to go to test');
        }
        
    }


    public function nextMateri($id_kelas) { //might need some refactoring
        $subcpmk = $this-> getCurrentSubCpmk($id_kelas);
        if($subcpmk){
            $currentMateri = $this->getCurrentMateri($id_kelas);
            if($currentMateri->minimum_time){
                $minimumTime = date('Y-m-d H:i:s',strtotime('+'.$currentMateri->minimum_time.' minutes',strtotime($currentMateri->current_materi_start_time)));
                if ((date("Y-m-d H:i:s")) > $minimumTime){
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
                    $subcpmkPengambilan->subcmpkFinished = true;
                    
                }
                else{
                    $nextIndikator = $subCpmkIndikator->where("nomorUrut_indikator", ">",$currentMateri->indikator->nomorUrut_indikator)->first();
                    // dd($nextIndikator);
                    $nextMateri = $nextIndikator->materi->sortBy("nomorUrut_materi")->first();
                    $materiId = $nextMateri->id_materi;
                    $subcpmkPengambilan->current_materi_id = $materiId;
                    $subcpmkPengambilan->current_materi_start_time = date("Y-m-d H:i:s");
                    $subcpmkPengambilan->save();
                    $subcpmkPengambilan->subcmpkFinished = false;
                }   
            }
            else{
                $nextMateri =$indikatorMateri->where("nomorUrut_materi", $currentMateri->nomorUrut_materi + 1 )->first();
                $materiId = $nextMateri->id_materi;
                $subcpmkPengambilan->current_materi_id = $materiId;
                $subcpmkPengambilan->current_materi_start_time = date("Y-m-d H:i:s");
                $subcpmkPengambilan->save();
                $subcpmkPengambilan->subcmpkFinished = false;
            }
            return $subcpmkPengambilan;
        }
        else{
            throw new \Exception('Siswa is not enrolled');
        }
    }
}
