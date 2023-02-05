<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengajar extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_pengajar",
        "identitas_pengajar",
        "email_pengajar",
        "nama_pengajar",
        "jenisKelamin_Pengajar",
        "tanggalLahir_Pengajar",
        "pathFileFoto_Pengajar",
        "account_active",
    ];
    protected $table = 'pengajar';
    protected $primaryKey = 'id_pengajar';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, "id_pengajar", "id");
    }
    public function kelas()
    {
        return $this->belongsToMany(kelas::class, "pengampuan", "id_pengajar", "id_kelas");
    }

    public function isMengampuMatakuliah($id_matakuliah){
        // $kelas = DB::table('kelas')
        //                     ->join('pengampuan', 'kelas.id_kelas', '=', 'pengampuan.id_kelas')
        //                     ->where('pengampuan.id_pengajar','=', $this->id_pengajar)
        //                     ->where('kelas.id_matakuliah', '=', $id_matakuliah)
        //                     ->first();
        $kelas = $this->kelas->where('id_matakuliah',$id_matakuliah)->first();
        if ($kelas){
            return true;
        }
        else{
            return false;
        }
    }
    public function isMengampuKelas($id_kelas){
        $kelas = $this->kelas->where('id_kelas',$id_kelas)->first();
        if($kelas){
            return true;
        }
        else{
            return false;
        }
    }
    public function matakuliah(){
        $matakuliah = DB::table('matakuliah')
                            ->join('kelas', 'matakuliah.id_matakuliah ','=', 'kelas.id_matakuliah')
                            ->join('pengampuan', 'kelas.id_kelas', '=', 'pengampuan.id_kelas')
                            ->where('pengampuan.id_pengajar','=', $this->id_pengajar)
                            ->get();
        return $matakuliah;
    }

}
