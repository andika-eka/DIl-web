<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCpmk;
use App\Models\PengambilanKelas;
use App\Models\SubcpmkPengambilan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{

    private function getSiswa(){
        $user = Auth::user();  
        if($user->tipe_pengguna != 3){
            
            abort(403);
        }  
        return $user->detail;
    }

    private function startKelas($id_kelas){
        $kelas = Kelas::find($id_kelas);
        $subcpmk = $kelas->matakuliah->subcpmk->sortBy("nomorUrut_subCpmk")->first();
        $pengambilankelas = PengambilanKelas::where([
            ['id_siswa', '=', Auth::user()->id],
            ['id_kelas', '=', $id_kelas]
        ])->first();
        $subPengambilan = new SubcpmkPengambilan;
        $subPengambilan->id_pengambilanKelas = $pengambilankelas->id_pengambilanKelas;
        $subPengambilan->id_subCPMK = $subcpmk->id_subCpmk;
        $subPengambilan->waktuMulai_Pengambilan = date("Y-m-d H:i:s");
        $subPengambilan->status_subcpmkpengambilan = 1;
        $subPengambilan->save();
    }
    public function currentUnit($id_kelas){
        try
        {
            $subcpmk = $this->getSiswa()->getProgressSubCpmk($id_kelas);
            $currentSubcpmk = $this->getSiswa()->getCurrentSubCpmk($id_kelas);
            if ($subcpmk  === false){
                throw new \Exception("Siswa not enrolled");
            }
            if((!count($subcpmk))and (!$currentSubcpmk)){
                $this->startKelas($id_kelas);
                $subcpmk = $this->getSiswa()->getProgressSubCpmk($id_kelas);
                $currentSubcpmk =$this->getSiswa()->getCurrentSubCpmk($id_kelas);
            }
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
}
