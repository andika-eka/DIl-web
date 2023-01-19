<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TesFormatif;
use App\Models\SubcpmkPengambilan;
use App\Models\Kelas;
use App\Models\SubCpmk;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

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


    /**
     * 
     *
     * get all tes formatif attempt made by logged in siswa
     * 
     * @param  integer $id_kelas
     * @return \Illuminate\Http\Response
     */
    public function TesFormatif($id_kelas){
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
            $currentSubcpmk = $this-> getSiswa()->getCurrentSubCpmk($id_kelas);
            $subcpmkPengambilan = SubcpmkPengambilan::find($currentSubcpmk->id_subcpmkpengambilan);
            $testNumber =  $subcpmkPengambilan->tesFormatif->count();
            $currentTest = $subcpmkPengambilan->CurrentTesFormatif();
            if($currentTest){
                throw new \Exception ("current test is not finished");
            }
            else if($testNumber >= 3){
                throw new \Exception ("attemp limit has been reached");
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
            throw new \Exception ("there is no current test");
        }
        return TesFormatif::find($currentTest->id_tesFormatif);
    }

    public function startTesFormatif($id_kelas){
        try
        {
            $tesFormatif =  $this->getCurrentTest($id_kelas);
            $tesFormatif->startTesFomatif();
            return response()->json($tesFormatif->detail);
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

}
