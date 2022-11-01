<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;


class SiswaController extends Controller
{
    //
    // public function update(Request $request, $id,)
    public function update(Request $request)
    {
        try
        {
            $user = Auth::user();
            if ($user->tipe_pengguna != 3)
            {
                throw new \Exception("wrong user type");
            }
            $siswa = Siswa::find($user->id);
            $siswa->identitas_siswa  = $request->identitas_siswa;
            $siswa->email_siswa = $request-> email_siswa;
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->jenisKelamin_siswa = $request->jenisKelamin_siswa;
            $siswa->tanggalLahir_siswa = $request->tanggalLahir_siswa;
            $siswa->pathFileFoto_siswa = $request->pathFileFoto_siswa;
            $user->email = $request->email_siswa;
            
            $user->save();
            $siswa->save();
            $this->accountActivation($siswa);
            return response()->json([
                'data' =>  $user,
                'success' => true,
                'notif'=>'data updated',     
            ],200);

        }
        catch (\Exception $e){
            return response()->json([
                'message' => $e,
                'success' => false,
                'notif'=>'Error',               
            ], 422);
        }
    }
    
    private function accountActivation(Siswa $siswa)
    {
        if ($this->checkNotNull($siswa))
        {
            
            $siswa->account_active = true;
        }
        else
        {
            $siswa->account_active = false;
        }
        $siswa->save();
    }

    private function checkNotNull(Siswa $siswa)
    {
        if (is_null($siswa->identitas_siswa))
        {
            return false;
        }
        if (is_null($siswa->email_siswa))
        {
            return false;
        }
        if (is_null($siswa->nama_siswa))
        {
            return false;
        }
        if (is_null($siswa->jenisKelamin_siswa))
        {
            return false;
        }
        if (is_null($siswa->tanggalLahir_siswa))
        {
            return false;
        }
        return true;
    }
}
