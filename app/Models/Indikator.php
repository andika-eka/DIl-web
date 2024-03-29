<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $table = 'indikator';
    protected $primaryKey = 'id_indikator';
    protected $fillable = [
        "id_indikator",
        "id_subCpmk",
        "nomorUrut_indikator",
        "narasi_indikator",
        "pertemuanKe",
        "level_indikator",
    ];
    public $timestamps = false;
    
    public function subcpmk(){
        return $this->belongsTo(SubCpmk::class,'id_subCpmk', 'id_subCpmk');
    }
    public function materi(){
        return $this->hasMany(Materi::class, 'id_indikator', 'id_indikator');
    }
    public function soal(){
        return $this->hasMany(Soalpilihanganda::class, 'id_indikator', 'id_indikator');
    }

}