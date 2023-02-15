<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class SiswaManagementController extends Controller
{
    //
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

    public function getEnrolledSiswa($id_kelas){
        
        try
        {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $siswa = $kelas->enrolled();
            return response()->json([
                'siswa' =>  $siswa,
                'success' => true,
            ],200);
        }
        
        catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function getApplyingSiswa($id_kelas){
        
        try
        {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $siswa = $kelas->applying();
            return response()->json([
                'siswa' =>  $siswa,
                'success' => true,
            ],200);
        }
        
        catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function approveSiswa($id_kelas, $id_siswa){
        try {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $kelas->approveSiswa($id_siswa);
            return response()->json([
                'success' => true,
                'notif'=>' siswa approved',
            ],200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }


}
