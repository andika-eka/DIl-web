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

    // public function sumatif(){
    //     return $this->belongsToMany(Sumatif::class, "pengambilankelas", "id_kelas", "id_pengambilanKelas");
    // }

    public function sumatif(){
        return DB::table('sumatif')
                ->join('pengambilankelas', 'sumatif.id_pengambilanKelas', '=', 'pengambilankelas.id_pengambilanKelas')
                ->join('siswa', 'pengambilankelas.id_siswa', '=', 'siswa.id_siswa')
                ->select('siswa.*', "sumatif.*")
                ->where('pengambilankelas.id_kelas', $this->id_kelas)
                ->get();
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
                    ->select('siswa.*', 'pengambilankelas.*',)
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
                    ->select('siswa.*', 'pengambilankelas.*',)
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
    public function FormatifResult($id_subcpmk){
        $siswa = DB::table('siswa')
            ->join('pengambilankelas', 'siswa.id_siswa', '=', 'pengambilankelas.id_siswa')
            ->join('subcpmkpengambilan', 'pengambilankelas.id_pengambilanKelas', '=', 'subcpmkpengambilan.id_pengambilanKelas')
            ->join('tesformatif', 'subcpmkpengambilan.id_subcpmkpengambilan', '=', 'tesformatif.id_subcpmkpengambilan')
            ->select('siswa.*', 'tesformatif.*',)
            ->where('pengambilankelas.id_kelas','=', $this->id_kelas)
            ->where('subcpmkpengambilan.id_subCPMK', '=',  $id_subcpmk)
            ->get();
        return $siswa;    
    }

    public function lockedSiswa(){
        $siswa = DB::table('siswa')
            ->join('pengambilankelas', 'siswa.id_siswa', '=', 'pengambilankelas.id_siswa')
            ->join('subcpmkpengambilan', 'pengambilankelas.id_pengambilanKelas', '=', 'subcpmkpengambilan.id_pengambilanKelas')
            ->join('tesformatif', 'subcpmkpengambilan.id_subcpmkpengambilan', '=', 'tesformatif.id_subcpmkpengambilan')
            ->join('subcpmk', 'subcpmkpengambilan.id_subCPMK', '=', 'subcpmk.id_subCpmk')
            ->select('siswa.*', 'tesformatif.*', 'subcpmk.*',DB::raw('max(tesformatif.nilai_tesFormatif) as max_nilai'))
            ->groupBy('siswa.id_siswa')
            ->where('pengambilankelas.id_kelas','=', $this->id_kelas)
            ->where('subcpmkpengambilan.status_subcpmkpengambilan', '=', 3)
            ->get();
        return $siswa;
        
    }

}
