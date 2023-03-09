<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingKelas extends Model
{
    use HasFactory;
    protected $table = 'setting_kelas';
    protected $primaryKey = 'id_settting_kelas';
    protected $fillable = [
        "id_settting_kelas",
        "bobotC1",
        "bobotC2",
        "bobotC3",
        "bobotC4",
        "bobotC5",
        "bobotC6",
        "KKM",
        "waktu_tunggu_formatif", //jam
        "tgl_sumatif",
        "soal_formatif_per_indikator",
        "soal_sumatif_per_indikator",
        "waktu_per_soal_formatif",
        'batas_pengulangan_remidi',
        "waktu_per_soal_sumatif", 
        'path_gambar',
    ];

    public function getBobotArray(){
        $array =  [ 
            $this->bobotC1,
            $this->bobotC2,
            $this->bobotC3,
            $this->bobotC4,
            $this->bobotC5,
            $this->bobotC6,];
        return $array;
    }

    public function canStartFormatif($waktuSelesai_tesFormatif){
        $limit = strtotime($waktuSelesai_tesFormatif.'+'.$this->waktu_tunggu_formatif.'hours');
        if (strtotime(date("Y-m-d H:i:s")) > $limit){
            return true;
        }
        else{
            return false;
        }
    }


    public function sumatifIsAvailable(){
        $sumatifDate = strtotime($this->tgl_sumatif);//Y-m-d H:i:s
        if(date('Y-m-d', $sumatifDate) == date('Y-m-d')){
            return true;
        }else{
            return false;
        }
    }
    
    
}
