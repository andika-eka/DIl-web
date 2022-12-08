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
    private function isEnrolledInKelas($id_kelas){
        $kelas = Kelas::find($id_kelas);
        return $kelas->siswa->contains($this->id_siswa);
    }
    public function subcmpkbyKelas($id_kelas){
        if($this->isEnrolledInKelas($id_kelas)){
            $kelas = Kelas::find($id_kelas);
            $subcpmk = $kelas->matakuliah->subcpmk->sortBy('nomorUrut_subCpmk');
            
            return $subcpmk;
        }
        else{
            return false;
        }
    }

    public function getProgressSubCpmk($id_kelas){
        if($this->isEnrolledInKelas($id_kelas)){
            $subcpmk = DB::table('subcpmk')
                        ->join('subcpmkpengambilan', 'subcpmk.id_subCpmk', '=', 'subcpmkpengambilan.id_subCPMK')
                        ->join('pengambilankelas', 'subcpmkpengambilan.id_pengambilanKelas', '=', 'pengambilankelas.id_pengambilanKelas')
                        ->select('subcpmk.*', 'subcpmkpengambilan.*', 'subcpmkpengambilan.*')
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
            return false;
        }
    }
    public function getCurrentSubCpmk($id_kelas){
        if($this->isEnrolledInKelas($id_kelas)){
            $subcpmk = DB::table('subcpmk')
                        ->join('subcpmkpengambilan', 'subcpmk.id_subCpmk', '=', 'subcpmkpengambilan.id_subCPMK')
                        ->join('pengambilankelas', 'subcpmkpengambilan.id_pengambilanKelas', '=', 'pengambilankelas.id_pengambilanKelas')
                        ->select('subcpmk.*', 'subcpmkpengambilan.*', 'subcpmkpengambilan.*')
                        ->where([
                            ['pengambilankelas.id_siswa', '=', $this->id_siswa],
                            ['pengambilankelas.id_kelas', '=',  $id_kelas],
                            ['subcpmkpengambilan.status_subcpmkpengambilan', '=', 1],
                        ])
                        ->get();
            return $subcpmk;
        }
        else{
            return false;
        }
    }
    


}
