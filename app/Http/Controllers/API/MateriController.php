<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Materi;
use App\Models\Indikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{

    private function checkAccessToMatkul($id_matakuliah){
        $user = Auth::user();
        if($user->tipe_pengguna != 2){
            abort(403);
        }
        $pengajar =$user->detail;
        if (!$pengajar->isMengampuMatakuliah($id_matakuliah)){
            abort(403);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request, $inid)
    {
        //
        try
        {
            $indikator = Indikator::find($inid);
            $this->checkAccessToMatkul($indikator->subcpmk->id_mataKuliah);
            $materi = new Materi;
            $materi->id_indikator = $inid;
            $materi->nomorUrut_materi = $request->nomorUrut_materi;
            $materi->nama_materi = $request->nama_materi;
            $materi->pathFile_materi = $request->pathFile_materi;
            $materi->minimum_time = $request->minimum_time;
            $materi->save();
            return response()->json([
                'soal' =>$materi,
                'success' => true,
                'notif'=>'materi has `been created',
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
     * @param  \App\Models\materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try
        {
            $materi = Materi::find($id);
            $this->checkAccessToMatkul($materi->indikator->subcpmk->id_mataKuliah);
            $materi->indikator;
            return response()->json($materi);
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
     * @param  \App\Models\materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try
        {
            $materi = Materi::find($id);
            $this->checkAccessToMatkul($materi->indikator->subcpmk->id_mataKuliah);
            $materi->nomorUrut_materi = $request->nomorUrut_materi;
            $materi->nama_materi = $request->nama_materi;
            $materi->pathFile_materi = $request->pathFile_materi;
            $materi->minimum_time = $request->minimum_time;
            $materi->save();
            return response()->json([
                'materi' =>$materi,
                'success' => true,
                'notif'=>'materi has been updated',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            $materi = Materi::find($id);
            $this->checkAccessToMatkul($materi->indikator->subcpmk->id_mataKuliah);
            $materi->delete();
            return response()->json([
                'success' => true,
                'notif'=>'indikator has been deleted',
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
}
