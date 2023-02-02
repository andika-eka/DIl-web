<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengambilanKelas;
use App\Models\Sumatif;
use Illuminate\Support\Facades\Auth;

class SumatifController extends Controller
{
    //
    private function getSiswa(){
        $user = Auth::user();  
        if($user->tipe_pengguna != 3){
            
            abort(403);
        }  
        return $user->detail;
    }
    
    public function createTesSumatif($id_kelas){
        try
        {
            $siswa = $this->getSiswa();
            if ($siswa->getTesSumatif($id_kelas)){
                throw new \Exception ("tes already created");
            }
            $pengambilanKelas = PengambilanKelas::where('id_kelas',$id_kelas)
                        ->where('id_siswa',$siswa->id_siswa)->first();
            
            $sumatif = new Sumatif;
            $sumatif->id_pengambilanKelas = $pengambilanKelas->id_pengambilanKelas;
            $sumatif->save();
            return response()->json($sumatif);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function getCurrentSumatif($id_kelas){
        try
        {
            $siswa = $this->getSiswa();
            $currentSumatif = $siswa->getTesSumatif($id_kelas);
            if (!$currentSumatif){
                // dd($currentSumatif);
                $this->createTesSumatif($id_kelas);
                $currentSumatif = $siswa->getTesSumatif($id_kelas);
            }
            return response()->json($currentSumatif);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function startTestSumatif($id_kelas){
        try
        {
            $siswa = $this->getSiswa();
            $sumatif =  $siswa->getTesSumatif($id_kelas);
            $sumatif->startTesSumatif();
            $sumatif->detail;
            return response()->json($sumatif);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function getSoal($id_kelas, $no_soal){
        try
        {
            $siswa = $this->getSiswa();
            $sumatif =  $siswa->getTesSumatif($id_kelas);
            $soal = $sumatif->showSoal( $no_soal);
            return response()->json([
                'time remining' => $sumatif->getTimeRemaining(),
                'soal count' => $sumatif->detail->count(),
                'soal' => $soal,
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

    public function submitJawaban(Request $request, $id_kelas, $no_soal){
        try
        {
            $siswa = $this->getSiswa();
            $sumatif =  $siswa->getTesSumatif($id_kelas);
            $detail = $sumatif->saveJawaban($request->noUrut_pilihan, $no_soal );
            $detail->jawaban->soal;
            return response()->json($detail);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
        
    }

    public function finishTestSumatif($id_kelas){
        try
        {
            $siswa = $this->getSiswa();
            $sumatif =  $siswa->getTesSumatif($id_kelas);
            $sumatif->endTesSumatif();
            return response()->json($sumatif);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
        
    }


    public function sumatifInfo($id_kelas){
        try
        {
            $siswa = $this->getSiswa();
            $sumatif =  $siswa->getTesSumatif($id_kelas);
            return response()->json([
                'tes' => $sumatif,
                'jawaban' => $sumatif->veryDetail(),
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

}
