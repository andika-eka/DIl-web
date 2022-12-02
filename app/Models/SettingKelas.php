<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingKelas extends Model
{
    use HasFactory;
    protected $table = 'setting_kelas';
    protected $primaryKey = 'id_settting_kelas';
    protected $fillable = [
        "id_settting_kelas",
        "Mulai",
        "Berakhir",
        "bobotC1",
        "bobotC2",
        "bobotC3",
        "bobotC4",
        "bobotC5",
        "bobotC6",
        "KKM",
        "waktu_tunggu_formatif",
        "tgl_sumatif",
    ];
}
