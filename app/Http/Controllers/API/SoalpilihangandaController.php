<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use App\Models\Soalpilihanganda;
use Illuminate\Http\Request;

class SoalpilihangandaController extends Controller
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
    public function store(Request $request, $inid)
    {
        //
        try
        {
            $soal = new Soalpilihanganda;
            $soal->id_indikator = $inid;
            $soal->soal = $request->soal;
            if ($request->has("gambar")){
                $file = $request->file('gambar');
                $fileName = time().'.'.$file->extension();
                
                $filePath = public_path(). '\\files\\soal\\';
                $file->move($filePath, $fileName);
                $soal->pathFileGambar_soal = $filePath.$fileName;
            }
            else{
                $soal->pathFileGambar_soal = NULL;
            }
            
            $soal->save();
            return response()->json([
                'soal' =>$soal,
                'success' => true,
                'notif'=>'soal has been created',
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
     * @param  \App\Models\Soalpilihanganda  $soalpilihanganda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try
        {
            $soal = Soalpilihanganda::find($id);
            $soal->indikator;
            $soal->jawaban->makeHidden("status_pilihan");
            return response()->json($soal);
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
     * @param  \App\Models\Soalpilihanganda  $soalpilihanganda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        try
        {
            $soal = Soalpilihanganda::find($id);
            $soal->soal = $request->soal;
            if ($request->has("gambar")){
                $filePath = $soal->pathFile_materiTeks;
                File::delete($filePath);
                $file = $request->file('gambar');
                $fileName = time().'.'.$file->extension();
                
                $filePath = public_path(). '\\files\\soal\\';
                $file->move($filePath, $fileName);
                $soal->pathFileGambar_soal = $filePath.$fileName;
            }
            $soal->save();
            return response()->json([
                'soal' =>$soal,
                'success' => true,
                'notif'=>'soal has been updated',
            ],200);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        } 
    }
    public function removePic($id)
    {
        try
        {
            $soal = Soalpilihanganda::find($id);
            $filePath = $soal->pathFile_materiTeks;
            File::delete($filePath);
            $soal->pathFileGambar_soal = NULL;
            $soal->save();
            return response()->json([
                'soal' =>$soal,
                'success' => true,
                'notif'=>'soal has been updated successfully',
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soalpilihanganda  $soalpilihanganda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            $soal = Soalpilihanganda::find($id);
            $soal->delete();
            return response()->json([
                'success' => true,
                'notif'=>'soal has been deleted',
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
