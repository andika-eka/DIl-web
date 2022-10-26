<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'identitas_siswa',
        'email_siswa',
        'nama_siswa',
        'jenisKelamin_siswa',
        'tanggalLahir_siswa',
        'pathFileFoto_siswa',
        'account_active',
    ];

    protected $table = "siswa";
    protected $primaryKey = "id_siswa";

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,  "id_siswa", "id");
    }
    public function kelas()
    {
        return $this->belongsToMany(kelas::class, "pengambilankelas", "id_siswa", "id_kelas");
    }

}
