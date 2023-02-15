<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pilihanjawaban;
use App\Models\Soalpilihanganda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;

class PilihanjawabanController extends Controller
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
    public function store(Request $request, $soal_id)
    {
        //
        try
        {
            $soal = Soalpilihanganda::find($soal_id);
            $this->checkAccessToMatkul($soal->indikator->subcpmk->id_mataKuliah);
            $jawaban = new Pilihanjawaban;
            $jawaban->id_soalPilihanGanda = $soal_id;
            $jawaban->noUrut_pilihan = $request->noUrut_pilihan;
            $jawaban->teks_pilihan = $request->teks_pilihan;
            $jawaban->status_pilihan = $request->status_pilihan;
            if ($request->has("gambar")){
                $file = $request->file('gambar');
                $fileName = time().'.'.$file->extension();
                
                $filePath = public_path(). '\\files\\jawaban\\';
                $file->move($filePath, $fileName);
                $jawaban->pathFileGambar_pilihan = $filePath.$fileName;
            }
            else{
                $jawaban->pathFileGambar_pilihan = NULL;
            }
            
            $jawaban->save();
            return response()->json([
                'jawaban' =>$jawaban,
                'success' => true,
                'notif'=>'jawaban has been created',
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
     * @param  \App\Models\Pilihanjawaban  $pilihanjawaban
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try
        {
            $jawaban = Pilihanjawaban::find($id);
            $this->checkAccessToMatkul($jawaban->soal->indikator->subcpmk->id_mataKuliah);
            $jawaban->soal;
            return response()->json($jawaban);
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
     * @param  \App\Models\Pilihanjawaban  $pilihanjawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try
        {
            $this->checkAccessToMatkul($jawaban->soal->indikator->subcpmk->id_mataKuliah);
            $jawaban = Pilihanjawaban::find($id);
            $jawaban->noUrut_pilihan = $request->noUrut_pilihan;
            $jawaban->teks_pilihan = $request->teks_pilihan;
            $jawaban->status_pilihan = $request->status_pilihan;
            if ($request->has("gambar")){
                $filePath = $jawaban->pathFile_materiTeks;
                File::delete($filePath);
                $file = $request->file('gambar');
                $fileName = time().'.'.$file->extension();
                
                $filePath = public_path(). '\\files\\jawaban\\';
                $file->move($filePath, $fileName);
                $jawaban->pathFileGambar_pilihan = $filePath.$fileName;
            }
            $jawaban->save();
            return response()->json([
                'jawaban' =>$jawaban,
                'success' => true,
                'notif'=>'jawaban has been updated',
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
            $jawaban = Pilihanjawaban::find($id);
            $this->checkAccessToMatkul($jawaban->soal->indikator->subcpmk->id_mataKuliah);
            $filePath = $jawaban->pathFile_materiTeks;
            File::delete($filePath);
            $jawaban->pathFileGambar_pilihan = NULL;
            $jawaban->save();
            return response()->json([
                'jawaban' =>$jawaban,
                'success' => true,
                'notif'=>'jawaban has been updated',
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
     * @param  \App\Models\Pilihanjawaban  $pilihanjawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        try
        {
            $jawaban = Pilihanjawaban::find($id);
            $this->checkAccessToMatkul($jawaban->soal->indikator->subcpmk->id_mataKuliah);
            $jawaban->delete();
            return response()->json([
                'success' => true,
                'notif'=>'jawaban has been deleted',
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
