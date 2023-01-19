<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengambilanKelas;
use App\Models\SubcpmkPengambilan;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

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
            $nextMateri = $this->getSiswa()->nextMateri($id_kelas);
            if($nextMateri->subcmpkFinished){
                return response()->json([
                    'subcpmkPengambilan' => $nextMateri,
                    'currentMateri' => NULL,
                ]);
            }
            else{
                return response()->json([
                    'subcpmkPengambilan' => $nextMateri,
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
        // try
        // {
            $subcpmk = $this->getSiswa()->getProgressSubCpmk($id_kelas);
            $this->getSiswa()->nextSubcpmk($id_kelas);

            $currentSubcpmk = $this->getSiswa()->getCurrentSubCpmk($id_kelas);

            return response()->json([
                'current' => $currentSubcpmk,
                'completed' => $subcpmk,
            ]);
        // }
        // catch (\Exception $e)
        // {
        //     return response()->json([
        //         'message' => $e->getMessage(),
        //         'success' => false,
        //     ], 422);
        // }
    }
}
