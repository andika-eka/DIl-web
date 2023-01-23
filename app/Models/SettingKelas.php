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
        "Mulai",
        "Berakhir",
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

    public function kelasIsRunning(){
        try{
            $start = strtotime($this->Mulai);
            $stop = strtotime($this->Berakhir);
        }
        catch (\Exception $e)
        {
            return true;
        }
        $now = strtotime(date("Y-m-d H:i:s"));
        if(($start < $now) and ($now < $stop)){
            return true;
        }
        else{
            return false;
        }
    }
    
}
