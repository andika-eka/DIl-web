<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah';
    protected $primaryKey = 'id_matakuliah';
    protected $fillable = [
        "id_matakuliah",
        "kode_mataKuliah",
        "nama_mataKuliah",
        "cpmk",
        "semester_matkul"
    ];
    public $timestamps = false;

    public function kelas(){
        return $this->hasMany(Kelas::class, 'id_matakuliah', 'id_matakuliah');
    }
    public function subCpmk()
    {
        return $this->hasMany(SubCpmk::class,'id_mataKuliah', 'id_matakuliah' );
    }
}
