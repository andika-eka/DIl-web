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
        'status_subcpmkpengambilan',
        'current_materi_id',
        'current_materi_start_time',
    ];
    public $timestamps = false;


}
