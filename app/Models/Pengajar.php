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
    public $timestamps = false;
}
