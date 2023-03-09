<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTesSumatif extends Model
{
    use HasFactory;
    protected $table = 'detail_tes_sumatif';
    protected $primaryKey = 'id_detail_sumatif';
    protected $fillable = [
        'id_detail_sumatif',
        'id_sumatif',
        'no_soal',
        'id_pilihanJawaban',
        'id_soalPilihanGanda'
        ];
    
    public function jawaban(){
        return $this->belongsTo(Pilihanjawaban::class, 'id_pilihanJawaban', 'id_pilihanJawaban');
    }

    public function soal(){
        return $this->belongsTo(Soalpilihanganda::class, 'id_soalPilihanGanda', 'id_soalPilihanGanda');
    }

    public function sumatif(){
        return $this->belongsTo(Sumatif::class, 'id_sumatif', 'id_sumatif');
    }
    
}
