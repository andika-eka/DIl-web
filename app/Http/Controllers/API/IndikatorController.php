<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Indikator;
use App\Models\SubCpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndikatorController extends Controller
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
    public function store(Request $request, $scid)
    {
        //
        try
        {
            $subcpmk = SubCpmk::find($scid);
            $this->checkAccessToMatkul($subcpmk->id_mataKuliah);  
            $indikator = new Indikator;
            $indikator->id_subCpmk = $scid;
            $indikator->nomorUrut_indikator = $request->nomorUrut_indikator;
            $indikator->narasi_indikator = $request->narasi_indikator;
            $indikator->pertemuanKe = $request->pertemuanKe;
            $indikator->level_indikator = $request->level_indikator;
            $indikator->save();
        return response()->json([
                'indikator' =>$indikator,
                'success' => true,
                'notif'=>'indikator has `been created',
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
     * @param  \App\Models\indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try
        {
            $indikator = Indikator::find($id);
            $this->checkAccessToMatkul($indikator->subcpmk->id_mataKuliah);  
            $indikator->subcmpk;
            $indikator->materi;
            $indikator->soal;
            return response()->json($indikator);
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
     * @param  \App\Models\indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try
        {
            $indikator = Indikator::find($id);
            $this->checkAccessToMatkul($indikator->subcpmk->id_mataKuliah);  
            $indikator->nomorUrut_indikator = $request->nomorUrut_indikator;
            $indikator->narasi_indikator = $request->narasi_indikator;
            $indikator->pertemuanKe = $request->pertemuanKe;
            $indikator->level_indikator = $request->level_indikator;
            $indikator->save();
            return response()->json([
                'indikator' =>$indikator,
                'success' => true,
                'notif'=>'indikator has been updated',
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
     * @param  \App\Models\indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            $indikator = Indikator::find($id);
            $this->checkAccessToMatkul($indikator->subcpmk->id_mataKuliah);  
            $indikator->delete();
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
