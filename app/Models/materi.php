<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materi extends Model
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
    ];
    public $timestamps = false;
}
