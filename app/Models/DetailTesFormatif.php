<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTesFormatif extends Model
{
    use HasFactory;
    protected $table = 'detailtesformatif';
    protected $primaryKey = 'id_detailtesformatif';
    protected $fillable = [
        'id_detailtesformatif',
        'id_tesFormatif',
        'nomorUrut_soal',
        'id_pilihanJawaban',
        'alasanJawaban',
        'id_soalPilihanGanda'
        ];
    public $timestamps = false;
    
    public function tesFormatif(){
        return $this->belongsTo(TesFormatif::class,'id_tesFormatif', 'id_tesFormatif');
    }

    public function jawaban(){
        return $this->belongsTo(Pilihanjawaban::class, 'id_pilihanJawaban', 'id_pilihanJawaban');
    }

    public function soal(){
        return $this->belongsTo(Soalpilihanganda::class, 'id_soalPilihanGanda', 'id_soalPilihanGanda');
    }
}