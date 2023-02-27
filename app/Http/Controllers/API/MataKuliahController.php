<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mataKuliah = MataKuliah::all();
        return response()->json($mataKuliah);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try
        {
            $mataKuliah = new MataKuliah;
            $mataKuliah->kode_mataKuliah = $request->kode_mataKuliah;
            $mataKuliah->nama_mataKuliah = $request->nama_mataKuliah;
            $mataKuliah->cpmk = $request->cpmk;
            $mataKuliah->semester_matkul = $request->semester_matkul;

            $mataKuliah->save();
            
            return response()->json([
                'mataKuliah' =>$mataKuliah,
                'success' => true,
                'notif'=>'mataKuliah has been created',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try
        {
            $mataKuliah = MataKuliah::find($id);
            $mataKuliah->kelas;
            $mataKuliah->load('subCpmk.indikator.materi');
            return Response()->json($mataKuliah);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try
        {
            $this->checkAccessToMatkul($id);
            $mataKuliah = MataKuliah::find($id);
            $mataKuliah->kode_mataKuliah = $request->kode_mataKuliah;
            $mataKuliah->nama_mataKuliah = $request->nama_mataKuliah;
            $mataKuliah->cpmk = $request->cpmk;
            $mataKuliah->semester_matkul = $request->semester_matkul;
            $mataKuliah->save();
            return response()->json([
                'mataKuliah' =>$mataKuliah,
                'success' => true,
                'notif'=>'mataKuliah has been updated',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            $mataKuliah = MataKuliah::find($id);
            $mataKuliah->delete();
            return response()->json([
                'success' => true,
                'notif'=>'mataKuliah has been deleted',
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
