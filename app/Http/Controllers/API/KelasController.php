<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
        //
        $kelas = Kelas::all();
        return response()->json($kelas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Htt`p\Response
     */
    public function store(Request $request)
    {
        //
        try
        {
            $kelas = new Kelas;
            $kelas->id_matakuliah = $request->id_matakuliah;
            $kelas->tahun_kelas = $request->tahun_kelas;
            $kelas->semester_kelas = $request->semester_kelas;
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->tanggalBuat_kelas = $request->tanggalBuat_kelas;
            $kelas->tanggalMulai_kelas = $request->tanggalMulai_kelas;
            $kelas->tanggalSelesai_kelas = $request->tanggalSelesai_kelas;
            $kelas->status_kelas = $request->status_kelas;
            $kelas->jenis_kelas = $request->jenis_kelas;
            $kelas->save();
            return response()->json([
                'kelas' =>$kelas,
                'success' => true,
                'notif'=>'Kelas has `been created',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try
        {
            $kelas = Kelas::find($id);
            $kelas->matakuliah;
            return response()->json($kelas);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try
        {
            $kelas = Kelas::find($id);
            $kelas->id_matakuliah = $request->id_matakuliah;
            $kelas->tahun_kelas = $request->tahun_kelas;
            $kelas->semester_kelas = $request->semester_kelas;
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->tanggalBuat_kelas = $request->tanggalBuat_kelas;
            $kelas->tanggalMulai_kelas = $request->tanggalMulai_kelas;
            $kelas->tanggalSelesai_kelas = $request->tanggalSelesai_kelas;
            $kelas->status_kelas = $request->status_kelas;
            $kelas->jenis_kelas = $request->jenis_kelas;
            $kelas->save();
            return response()->json([
                'kelas' =>$kelas,
                'success' => true,
                'notif'=>'Kelas has updated successfully',
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
            $kelas = Kelas::find($id);
            $kelas->delete();
            return response()->json([
                'success' => true,
                'notif'=>'kelas has been deleted',
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
