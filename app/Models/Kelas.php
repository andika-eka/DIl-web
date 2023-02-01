<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelas extends Model
{
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
    
    public function matakuliah(){
        return $this->belongsTo(MataKuliah::class,'id_matakuliah', 'id_matakuliah');
    }
    public function siswa(){
        return $this->belongsToMany(Siswa::class, "pengambilankelas", "id_kelas", "id_siswa");
    }
    public function pengajar(){
        return $this->belongsToMany(Pengajar::class, "pengampuan", "id_kelas", "id_pengajar");
    }
    public function settings(){
        return $this->hasOne(SettingKelas::class, "id_settting_kelas", "id_kelas");
    }

    public function kelasIsRunning(){
        try{
            $start = strtotime($this->tanggalMulai_kelas);
            $stop = strtotime($this->tanggalSelesai_kelas);
        }
        catch (\Exception $e)
        {
            return true;
        }
        $now = strtotime(date("Y-m-d H:i:s"));
        if(($start < $now) and ($now < $stop)){
            return true;
        }
        else{
            return false;
        }
    }
    public function enrolled(){
        $siswa = DB::table("siswa")
                    ->join('pengambilankelas', 'siswa.id_siswa', '=', 'pengambilankelas.id_siswa')
                    ->join('kelas', 'pengambilankelas.id_kelas', '=', 'kelas.id_kelas')
                    ->select('siswa.*', 'pengambilankelas.status_pengambilanKelas', 'kelas.*')
                    ->where([
                        ['pengambilankelas.id_kelas', '=', $this->id_kelas],
                        ['pengambilankelas.status_pengambilanKelas', '=', 1],
                    ])
                    ->get();
        return $siswa;
    }

    public function applying(){
        $siswa = DB::table("siswa")
                    ->join('pengambilankelas', 'siswa.id_siswa', '=', 'pengambilankelas.id_siswa')
                    ->join('kelas', 'pengambilankelas.id_kelas', '=', 'kelas.id_kelas')
                    ->select('siswa.*', 'pengambilankelas.status_pengambilanKelas', 'kelas.*')
                    ->where([
                        ['pengambilankelas.id_kelas', '=', $this->id_kelas],
                        ['pengambilankelas.status_pengambilanKelas', '=', 2],
                    ])
                    ->get();
        return $siswa;
    }

    public function approveSiswa($id_siswa){
        $pengambilankelas = PengambilanKelas::where("id_siswa", "=", $id_siswa)
                            ->where('id_kelas', '=', $this->id_kelas)
                            ->first();
        $pengambilankelas->status_pengambilanKelas = 1;
        $pengambilankelas->save();
    }

}
