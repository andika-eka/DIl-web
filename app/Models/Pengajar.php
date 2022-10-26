<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_pengajar",
        "identitas_pengajar",
        "email_pengajar",
        "nama_pengajar",
        "jenisKelamin_Pengajar",
        "tanggalLahir_Pengajar",
        "pathFileFoto_Pengajar",
        "account_active",
    ];
    protected $table = 'pengajar';
    protected $primaryKey = 'id_pengajar';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, "id_pengajar", "id");
    }
    public function kelas()
    {
        return $this->belongsToMany(kelas::class, "pengampuan", "id_pengajar", "id_kelas");
    }

}
