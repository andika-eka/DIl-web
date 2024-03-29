<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    protected $fillable = [
        "id_materi",
        "id_indikator",
        "nomorUrut_materi",
        "nama_materi",
        "pathFile_materi",
        "minimum_time",
    ];
    public $timestamps = false;

    public function indikator(){
        return $this->belongsTo(Indikator::class, 'id_indikator', 'id_indikator');
    }
}
