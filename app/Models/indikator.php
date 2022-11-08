<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class indikator extends Model
{
    use HasFactory;
    protected $table = 'indikator';
    protected $primaryKey = 'id_indikator';
    protected $fillable = [
        "id_indikator",
        "id_subCpmk",
        "nomorUrut_indikator",
        "narasi_indikator",
        "pertemuanKe",
        "level_indikator",
    ];
    public $timestamps = false;
