<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        "id_kelas",
        "id_matakuliah",
        "tahun_kelas",
        "semester_kelas",
        "nama_kelas",
        "tanggalBuat_kelas",
        "tanggalMulai_kelas",
        "tanggalSelesai_kelas",
        "status_kelas",
        "jenis_kelas",
    ];
    public $timestamps = false;

}
