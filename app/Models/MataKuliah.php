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
    ];
    public $timestamps = false;
}
