<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Indikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

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
            $indikator = new Indikator;
            $indikator->id_subCpmk = $scid;
            $indikator->nomorUrut_indikator = $request->nomorUrut_indikator;
            $indikator->narasi_indikator = $request->narasi_indikator;
            $indikator->pertemuanKe = $request->pertemuanKe;
            $indikator->level_indikator = $request->level_indikator;
            $indikator->save();
        return response()->json([
                'subcpmk' =>$indikator,
                'success' => true,
                'notif'=>'indikator has `been created',
            ],200);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'notif'=>$e,               
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
            $indikator->subcmpk;
            return response()->json($indikator);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e,
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
            $indikator->nomorUrut_indikator = $request->nomorUrut_indikator;
            $indikator->narasi_indikator = $request->narasi_indikator;
            $indikator->pertemuanKe = $request->pertemuanKe;
            $indikator->level_indikator = $request->level_indikator;
            $indikator->save();
            return response()->json([
                'subcpmk' =>$indikator,
                'success' => true,
                'notif'=>'indikator has been updated',
            ],200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e,
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
            $indikator->delete();
            return response()->json([
                'success' => true,
                'notif'=>'indikator has been deleted',
            ],200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e,
                'success' => false,
            ], 422);
        }
    }
}
