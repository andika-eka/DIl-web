<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soalpilihanganda extends Model
{
    use HasFactory;
    protected $table = 'soalpilihanganda';
    protected $primaryKey = 'id_soalPilihanGanda';
    protected $fillable = [
        "id_soalPilihanGanda",
        "id_indikator",
        "soal",
        "pathFileGambar_soal",
    ];
    public $timestamps = false;
    
    public function indikator(){
        return $this->belongsTo(Indikator::class,'id_indikator', 'id_indikator');
    }
    public function jawaban(){
        return $this->hasMany(Pilihanjawaban::class, 'id_soalPilihanGanda', 'id_soalPilihanGanda');
    }
}
