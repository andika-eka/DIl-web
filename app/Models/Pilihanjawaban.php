<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilihanjawaban extends Model
{
    use HasFactory;
    protected $table = 'pilihanjawaban';
    protected $primaryKey = 'id_pilihanJawaban';
    protected $fillable = [
        
        'id_pilihanJawaban',
        'id_soalPilihanGanda',
        'noUrut_pilihan',
        'teks_pilihan',
        'status_pilihan',
        'pathFileGambar_pilihan',
    ];
    public $timestamps = false;

    public function soal(){
        return $this->belongsTo(Soalpilihanganda::class,'id_soalPilihanGanda', 'id_soalPilihanGanda');
    }
}
