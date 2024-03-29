<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pengampuan;
use App\Models\PengambilanKelas;
use App\Models\SettingKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 

class KelasController extends Controller
{
    /**
     * Display a listing of the resource by user
     *
     * @return \Illuminate\Http\Response
     */

    private function checkAccessToKelas($id_kelas){
        $user = Auth::user();
        if($user->tipe_pengguna != 2){
            abort(403);
        }
        $pengajar =$user->detail;
        if (!$pengajar->isMengampuKelas($id_kelas)){
            abort(403);
        }
        
    }


    public function index()
    {
        //
        $kelas = Kelas::all();
        return response()->json($kelas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Htt`p\Response
     */
    public function store(Request $request)
    {
        //
        try
        {
            $kelas = new Kelas;
            $kelas->id_matakuliah = $request->id_matakuliah;
            $kelas->tahun_kelas = $request->tahun_kelas;
            $kelas->semester_kelas = $request->semester_kelas;
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->tanggalBuat_kelas = $request->tanggalBuat_kelas;
            $kelas->tanggalMulai_kelas = $request->tanggalMulai_kelas;
            $kelas->tanggalSelesai_kelas = $request->tanggalSelesai_kelas;
            $kelas->status_kelas = $request->status_kelas;
            $kelas->jenis_kelas = $request->jenis_kelas;
            $kelas->save();
            $setting = new SettingKelas;
            $setting->id_settting_kelas = $kelas->id_kelas;
            $setting->save();
            return response()->json([
                'kelas' =>$kelas,
                'success' => true,
                'notif'=>'Kelas has `been created',
            ],200);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        } 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try
        {
            $kelas = Kelas::find($id);
            $kelas->matakuliah;
            $kelas->settings;
            $kelas->pengajar;

            $user = Auth()->user();
            if(($user->tipe_pengguna == 2) and ($user->detail->isMengampuKelas($id))){
                return response()->json([
                    'kelas' => $kelas,
                    'enrolled' => $kelas->enrolled(),
                    'applying' => $kelas->applying(),
                ]);
                }
            return response()->json([
                'kelas' => $kelas,
                'enrolled' => $kelas->enrolled(),
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try
        {
            $this->checkAccessToKelas($id);
            $kelas = Kelas::find($id);
            $kelas->id_matakuliah = $request->id_matakuliah;
            $kelas->tahun_kelas = $request->tahun_kelas;
            $kelas->semester_kelas = $request->semester_kelas;
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->tanggalBuat_kelas = $request->tanggalBuat_kelas;
            $kelas->tanggalMulai_kelas = $request->tanggalMulai_kelas;
            $kelas->tanggalSelesai_kelas = $request->tanggalSelesai_kelas;
            $kelas->status_kelas = $request->status_kelas;
            $kelas->jenis_kelas = $request->jenis_kelas;
            $kelas->save();
            return response()->json([
                'kelas' =>$kelas,
                'success' => true,
                'notif'=>'Kelas has updated successfully',
            ],200);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            $kelas = Kelas::find($id);
            $kelas->delete();
            return response()->json([
                'success' => true,
                'notif'=>'kelas has been deleted',
            ],200);
        }        
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function addPengajar(Request $request, $id)
    {
        try
        {
            $kelas = Kelas::find($id);
            $pengampuan = new Pengampuan;
            $pengampuan->id_kelas = $kelas->id_kelas;
            $pengampuan->id_pengajar = $request->id_pengajar;
            $pengampuan->status_pengampuan = $request->status_pengampuan;
            $pengampuan->save();
            return response()->json([
                'success' => true,
                'notif'=>'pengajar has been added to kelas',
            ],200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function addSiswa(Request $request, $id)
    {
        try
        {
            $kelas = Kelas::find($id);
            $pengambilanKelas = new PengambilanKelas;
            $pengambilanKelas->id_kelas = $kelas->id_kelas;
            $pengambilanKelas->id_siswa = $request->id_siswa;
            $pengambilanKelas->status_pengambilanKelas = $request->status_pengambilanKelas;
            $pengambilanKelas->save();
            return response()->json([
                'success' => true,
                'notif'=>'siswa has been added to kelas',
            ],200);
        }
        catch (\Exception $e)
        { 
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
    public function removePengajar($id, $id_pengajar)
    {
        try
        {
            $pengampuan = Pengampuan::where("id_pengajar", '=', $id_pengajar)
                                                ->where("id_kelas", "=", $id)
                                                ->first();
            $pengampuan->delete();
            return response()->json([
                'success' => true,
                'notif'=>' pengajar removed',
            ],200);
        }
        
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e,
                'success' => false,
                'notif'=>'error',               
            ], 422);
        }
        
    }
    public function removeSiswa($id, $id_siswa)
    {
        try
        {
            $pKelas = PengambilanKelas::where("id_siswa", '=', $id_siswa)
                                                ->where("id_kelas", "=", $id)
                                                ->first();
            $pKelas->delete();
            return response()->json([
                'success' => true,
                'notif'=>' siswa removed',
            ],200);
        }
        
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
        
    }

    
    public function getKelasSettings($id){
        try {
            $this->checkAccessToKelas($id);
            $setting = SettingKelas::find($id);
            return response()->json([
                'settings' =>$setting,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function applySettings(Request $request, $id){
        try {
            $this->checkAccessToKelas($id);
            $setting = SettingKelas::find($id);
            $setting->bobotC1 = $request->bobotC1;
            $setting->bobotC2 = $request->bobotC2;
            $setting->bobotC3 = $request->bobotC3;
            $setting->bobotC4 = $request->bobotC4;
            $setting->bobotC5 = $request->bobotC5;
            $setting->bobotC6 = $request->bobotC6;
            $setting->KKM = $request->KKM;
            $setting->waktu_tunggu_formatif = $request->waktu_tunggu_formatif;
            $setting->soal_formatif_per_indikator = $request->soal_formatif_per_indikator;
            $setting->soal_sumatif_per_indikator = $request->soal_sumatif_per_indikator;
            $setting->waktu_per_soal_formatif = $request->waktu_per_soal_formatif;
            $setting->waktu_per_soal_sumatif = $request->waktu_per_soal_sumatif;
            $setting->batas_pengulangan_remidi = $request->batas_pengulangan_remidi;
            $jsDateTS = strtotime($request->tgl_sumatif);
            $setting->tgl_sumatif = date('Y-m-d', $jsDateTS );
            $setting->save();
            return response()->json([
                'kelas' =>$setting,
                'success' => true,
                'notif'=>'settings has updated successfully',
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
    public function setDefaultSettings($id){
        try {
            $this->checkAccessToKelas($id);
            $setting = SettingKelas::find($id);
            $setting->Mulai =  date("Y-m-d");
            $setting->Berakhir = NULL;
            $setting->bobotC1 = 1;
            $setting->bobotC2 = 1;
            $setting->bobotC3 = 1;
            $setting->bobotC4 = 1;
            $setting->bobotC5 = 1;
            $setting->bobotC6 = 1;
            $setting->KKM = 75;
            $setting->waktu_tunggu_formatif = 0;
            $setting->tgl_sumatif = Null;
            $setting->soal_formatif_per_indikator = 1;
            $setting->soal_sumatif_per_indikator = 1;
            $setting->waktu_per_soal_formatif = 2;
            $setting->waktu_per_soal_sumatif = 2;
            $setting->batas_pengulangan_remidi  = 3;
            $setting->save();
            return response()->json([
                'kelas' =>$setting,
                'success' => true,
                'notif'=>'settings has updated successfully',
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function addPicture(Request $request, $id){
        try {
            $this->checkAccessToKelas($id);
            $setting = SettingKelas::find($id);
            $filePath = $setting->path_gambar;
            File::delete($filePath);
            $file = $request->file('gambar');
            $fileName = time().'.'.$file->extension();
            
            $filePath = public_path(). '\\files\\kelas\\';
            $file->move($filePath, $fileName);
            $setting->path_gambar = $filePath.$fileName;
            $setting->save();
            return response()->json([
                'kelas' =>$setting,
                'success' => true,
                'notif'=>'settings has updated successfully',
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function removePicture($id){
        try {
            $this->checkAccessToKelas($id);
            $setting = SettingKelas::find($id);
            $filePath = $setting->path_gambar;
            File::delete($filePath);
            $setting->path_gambar = NULL;
            $setting->save();
            return response()->json([
                'kelas' =>$setting,
                'success' => true,
                'notif'=>'settings has updated successfully',
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
        
}
