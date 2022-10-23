<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanKelas extends Model
{
    use HasFactory;
    protected $table = 'pengambilankelas';
    protected $primaryKey = 'id_pengambilanKelas';
    protected $fillable = [
        "id_pengambilanKelas",
        "id_siswa",
        "id_kelas",
        "status_pengambilanKelas",
    ];
    public $timestamps = false;

}
