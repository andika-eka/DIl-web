<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcpmkPengambilan extends Model
{
    use HasFactory;
    protected $table = 'subcpmkpengambilan';
    protected $primaryKey = 'id_subcpmkpengambilan';
    protected $fillable = [
        'id_subcpmkpengambilan',
        'id_pengambilanKelas',
        'id_subCPMK',
        'waktuMulai_Pengambilan',
        'waktuSelesai_Pengambilan',
        'status_subcpmkpengambilan', // 1 = unfinished, 2 = finished 
        'current_materi_id',
        'current_materi_start_time',
    ];
    public $timestamps = false;

    public function tesFormatif(){
        return $this->hasMany(TesFormatif::class, 'id_subCpmkPengambilan', 'id_subcpmkpengambilan');
    }

    public function completedTesFormatif(){
        return $this->tesFormatif->where("status_TesFormatif", '!=', 1);
    }

    public function CurrentTesFormatif(){
        $currentTest = $this->tesFormatif()->where("status_TesFormatif", '=', 1)->first();
        return $currentTest;
    }
    public function subCmpk(){
        return $this->belongsTo(SubCpmk::class, 'id_subCPMK','id_subCpmk');
    }
}
