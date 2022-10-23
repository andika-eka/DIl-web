<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengampuan extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'pengampuan';
    protected $primaryKey = 'id_pengampuan';
    protected $fillable = [
        "id_pengampuan",
        "id_siswa",
        "id_kelas",
        "status_pengampuan",
    ];
    public $timestamps = false;

}
