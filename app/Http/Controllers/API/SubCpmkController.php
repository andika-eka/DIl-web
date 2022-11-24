<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use App\Models\SubCpmk;
use Illuminate\Http\Request;

class SubCpmkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subcpmk = SubCpmk::all();
        return respose()->json($subcpmk);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $mkid)
    {
        
        try
        {
            $subcpmk = new SubCpmk;
            $subcpmk->id_mataKuliah = $mkid;
            $subcpmk->nomorUrut_subCpmk = $request->nomorUrut_subCpmk;
            $subcpmk->narasi_subCpmk = $request->narasi_subCpmk;
            
            $file = $request->file('materiTeks');
            $fileName = time().'.'.$file->extension();
            
            $filePath = public_path(). '\\files\\';
            $file->move($filePath, $fileName);
            
            $subcpmk->pathFile_materiTeks = $filePath.$fileName;
            $subcpmk->save();
          return response()->json([
                'subcpmk' =>$subcpmk,
                'success' => true,
                'notif'=>'SubCpmk has `been created',
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
     * @param  \App\Models\SubCpmk  $subCpmk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try
        {
            $subcpmk = SubCpmk::find($id);
            $subcpmk->mataKuliah;
            return response()->json($subcpmk);
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
     * @param  \App\Models\SubCpmk  $subCpmk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         try
        {
            $subcpmk = SubCpmk::find($id);
            $subcpmk->nomorUrut_subCpmk = $request->nomorUrut_subCpmk;
            $subcpmk->narasi_subCpmk = $request->narasi_subCpmk;
            $subcpmk->save();
            return response()->json([
                'subcpmk' =>$subcpmk,
                'success' => true,
                'notif'=>'SubCpmk has `been created',
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
    
    public function updateFile(Request $request, $id)
     {
        try
        {
            
            $subcpmk = SubCpmk::find($id);
            $filePath = $subcpmk->pathFile_materiTeks;
            File::delete($filePath);
            $file = $request->file('materiTeks');
            $fileName = time().'.'.$file->extension();
            
            $filePath = public_path(). '\\files\\';
            $file->move($filePath, $fileName);
            
            $subcpmk->pathFile_materiTeks = $filePath.$fileName;
            $subcpmk->save();
            
            return response()->json([
                'subcpmk' =>$subcpmk,
                'success' => true,
                'notif'=>'SubCpmk has `been created',
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
     * @param  \App\Models\SubCpmk  $subCpmk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            $subcpmk = SubCpmk::find($id);
            $filePath = $subcpmk->pathFile_materiTeks;
            File::delete($filePath);
            $subcpmk->delete();
            return response()->json([
                'success' => true,
                'notif'=>'SubCpmk has been deleted',
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
