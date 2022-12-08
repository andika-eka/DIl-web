<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanKelas extends Model
{
    use HasFactory;
    protected $table = 'pengambilankelas';
    protected $primaryKey = 'id_pengambilanKelas';
    protected $fillable = [
        "id_pengambilanKelas",
        "id_siswa",
        "id_kelas",
        "status_pengambilanKelas",
    ];
    public $timestamps = false;
    public function kelas(){
        return $this->belongsTo(Kelas::class, "id_kelas", "id_kelas");
    }
    public  function siswa(){
        return $this->belongsTo(Kelas::class, "id_siswa", "id_siswa");
    }
    
    public function subcpmk(){
        return $this->hasMany(SubCpmk::class, 'id_pengambilanKelas', 'id_pengambilanKelas');
    }
    
    
    
}
