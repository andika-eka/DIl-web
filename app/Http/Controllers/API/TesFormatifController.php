<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TesFormatif;
use App\Models\SubcpmkPengambilan;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;


class TesFormatifController extends Controller
{
    //
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

    /**
     * 
     *
     * get all tes formatif attempt made by logged in siswa
     * 
     * @param  integer $id_kelas
     * @return \Illuminate\Http\Response
     */
    public function tesFormatif($id_kelas){
        try
        {
            $currentSubcpmk = $this-> getSiswa()->getCurrentSubCpmk($id_kelas);
            $subcpmkPengambilan = SubcpmkPengambilan::find($currentSubcpmk->id_subcpmkpengambilan);
            $tesFormatif = $subcpmkPengambilan->completedTesFormatif();
            $currentTest = $subcpmkPengambilan->CurrentTesFormatif();
            return response()->json([
                'current' => $currentTest,
                'completed' => $tesFormatif,
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
     * 
     *
     * start a new test formatif
     * 
     * @param  integer $id_kelas
     * @return \Illuminate\Http\Response
     */
    public function createTestformatif($id_kelas){
        try
        {
            $this->checkStartEnd($id_kelas);
            $currentSubcpmk = $this-> getSiswa()->getCurrentSubCpmk($id_kelas);
            if ($currentSubcpmk->status_subcpmkpengambilan == 1){
                throw new \Exception ("current unit is not finished");
            }
            $subcpmkPengambilan = SubcpmkPengambilan::find($currentSubcpmk->id_subcpmkpengambilan);
            $testNumber =  $subcpmkPengambilan->tesFormatif->count();
            $currentTest = $subcpmkPengambilan->CurrentTesFormatif();
            $lastTest = $subcpmkPengambilan->completedTesFormatif()->sortByDesc("pengulangan_tesFormatif")->first();
            $settings = $subcpmkPengambilan->settingKelas();
            if($currentTest){
                throw new \Exception ("current test is not finished");
            }
            else if($testNumber >=  $settings->batas_pengulangan_remidi){
                throw new \Exception ("attemp limit has been reached");
            }
            else if($lastTest){
                if(!$settings->canStartFormatif($lastTest->waktuSelesai_tesFormatif)){
                    throw new \Exception ("need to wait ".$settings->waktu_tunggu_formatif.' hours before next test');
                }
            
            }
            $tesFormatif = new TesFormatif;
            $tesFormatif->id_subCpmkPengambilan = $currentSubcpmk->id_subcpmkpengambilan;
            $tesFormatif->pengulangan_tesFormatif = $testNumber +1;
            $tesFormatif->status_TesFormatif = 1;
            $tesFormatif->save();
            return response()->json($tesFormatif);

            
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    private function getCurrentTest($id_kelas){
        $currentSubcpmk = $this-> getSiswa()->getCurrentSubCpmk($id_kelas);
        $subcpmkPengambilan = SubcpmkPengambilan::find($currentSubcpmk->id_subcpmkpengambilan);
            
        $currentTest = $subcpmkPengambilan->CurrentTesFormatif();
        if(! $currentTest){
            $this->createTestformatif($id_kelas);
            $currentTest = $subcpmkPengambilan->CurrentTesFormatif();
        }
        return TesFormatif::find($currentTest->id_tesFormatif);
    }

    public function startTesFormatif($id_kelas){
        try
        {
            $this->checkStartEnd($id_kelas);
            $tesFormatif =  $this->getCurrentTest($id_kelas);
            $tesFormatif->startTesFomatif();
            $tesFormatif->detail;
            return response()->json($tesFormatif);
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
     * 
     *
     * get  question of current test
     * 
     * @param  integer $id_kelas
     * @return \Illuminate\Http\Response
     */
    public function getSoal($id_kelas, $no_soal){
        try
        {
            $tesFormatif =  $this->getCurrentTest($id_kelas);
            $soal = $tesFormatif->showSoal( $no_soal);
            return response()->json([
                'time remining' => $tesFormatif->getTimeRemaining(),
                'soal count' => $tesFormatif->detail->count(),
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

    

    /**
     * 
     *
     * submit jawaban for  current question of current test
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_kelas
     * @return \Illuminate\Http\Response
     */
    public function submitJawaban(Request $request, $id_kelas, $no_soal){
        try
        {
            $this->checkStartEnd($id_kelas);
            $tesFormatif =  $this->getCurrentTest($id_kelas);
            $detail = $tesFormatif->saveJawaban($request->noUrut_pilihan, $no_soal );
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

    public function finishTesFormatif($id_kelas){
        try
        {
            $this->checkStartEnd($id_kelas);
            $tesFormatif =  $this->getCurrentTest($id_kelas);
            $tesFormatif->endTesFormatif();
            return response()->json($tesFormatif);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
        
    }

    public function currentTestInfo($id_kelas){
        try
        {
            $tesFormatif =  $this->getCurrentTest($id_kelas);
            return response()->json([
                'tes' => $tesFormatif,
                'jawaban' => $tesFormatif->veryDetail(),
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
    
    public function testInfo($id_tesFormatif){
        try
        {
            $tesFormatif = TesFormatif::find($id_tesFormatif);
            if (! $tesFormatif->userHasAccess()) {
                abort(403);
            }
            return response()->json([
                'tes' => $tesFormatif,
                'jawaban' => $tesFormatif->veryDetail(),
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

    public function tesHistory($id_kelas){
        try
        {
            $tesHistory = $this->getSiswa()->getTesFormatifHistory($id_kelas);
            return response()->json($tesHistory);
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
