<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCpmk extends Model
{
    use HasFactory;
    protected $table = 'subcpmk';
    protected $primaryKey = 'id_subCpmk';
    protected $fillable = [
        "id_subCpmk",
        "id_mataKuliah",
        "nomorUrut_subCpmk",
        "narasi_subCpmk",
        "pathFile_materiTeks",
    ];
    public $timestamps = false;
    
    public function mataKuliah(){
       return $this->belongsTo(MataKuliah::class,'id_mataKuliah', 'id_matakuliah');
        
    }
}
