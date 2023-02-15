<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class LearningController extends Controller
{

    /**
     * 
     *
     * get details logged in siswa
     * @return App\Models\siswa
     */
    private function getSiswa(){
        $user = Auth::user();  
        if($user->tipe_pengguna != 3){
            
            abort(403);
        }  
        return $user->detail;
    }

    private function checkStartEnd($id_kelas){
        $kelas = Kelas::find($id_kelas);
        if(!$kelas->kelasIsRunning()){
            throw new \Exception("outside of Kelas period");
        }
    }


    public function currentUnit($id_kelas){
        try
        {
            $subcpmk = $this->getSiswa()->getProgressSubCpmk($id_kelas);
            $currentSubcpmk = $this->getSiswa()->getCurrentSubCpmk($id_kelas);
            return response()->json([
                'current' => $currentSubcpmk,
                'completed' => $subcpmk,
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


    public function allUnit($id_kelas){
        try
        {
            $subcpmk = $this->getSiswa()->subcmpkbyKelas($id_kelas);
            if ($subcpmk  === false){
                throw new \Exception("Siswa not enrolled");
            }
            return response()->json($subcpmk);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
    
    public function currentMateri($id_kelas){
        try
        {
            $currentMateri = $this->getSiswa()->getCurrentMateri($id_kelas);
            $materiList = $this->getSiswa()->getCurrentMateriList($id_kelas);
            return response()->json([
                'currentMateri' => $currentMateri,
                'materiList' => $materiList,
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
    public function nextMateri($id_kelas){
        try {
            $this->checkStartEnd($id_kelas);
            $nextMateri = $this->getSiswa()->nextMateri($id_kelas);
            if(!$nextMateri){
                return response()->json([
                    'currentMateri' => NULL,
                ]);
            }
            else{
                return response()->json([
                    'currentMateri' => $this->getSiswa()->getCurrentMateri($id_kelas),
                ]);
            }
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function nextUnit($id_kelas){
        try
        {
            $this->checkStartEnd($id_kelas);
            $subcpmk = $this->getSiswa()->getProgressSubCpmk($id_kelas);
            $nextSubcpmk = $this->getSiswa()->nextSubcpmk($id_kelas);
            if(!$nextSubcpmk){
                return response()->json([
                    'current' => NULL,
                    'completed' => $subcpmk,
                ]);
            }

            $currentSubcpmk = $this->getSiswa()->getCurrentSubCpmk($id_kelas);

            return response()->json([
                'current' => $currentSubcpmk,
                'completed' => $subcpmk,
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

    public function getFailedInfo($id_kelas){
        try
        {
            $top = $this->getSiswa()->topSiswa($id_kelas,3);
 
            $failed = $this->getSiswa()->fellowFailed($id_kelas);
            return response()->json([
                'top' => $top,
                'failed' => $failed,
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
