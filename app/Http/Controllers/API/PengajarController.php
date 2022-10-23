<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajar;
use Illuminate\Support\Facades\Auth;


class PengajarController extends Controller
{
    //
    public function update(Request $request)
    {
        try
        {
            $user = Auth::user();
            if ($user->tipe_pengguna != 2)
            {
                throw new \Exception("wrong user type");
            }
            $pengajar = Pengajar::find($user->id);
            $pengajar->identitas_pengajar  = $request->identitas_pengajar;
            $pengajar->email_pengajar = $request-> email_pengajar;
            $pengajar->nama_pengajar = $request->nama_pengajar;
            $pengajar->jenisKelamin_pengajar = $request->jenisKelamin_pengajar;
            $pengajar->tanggalLahir_pengajar = $request->tanggalLahir_pengajar;
            $pengajar->pathFileFoto_pengajar = $request->pathFileFoto_pengajar;
            $user->email = $request->email_pengajar;
            
            $user->save();
            $pengajar->save();
            $this->accountActivation($pengajar);
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
    private function accountActivation(Pengajar $pengajar)
    {
        if ($this->checkNotNull($pengajar))
        {
            
            $pengajar->account_active = true;
        }
        else
        {
            $pengajar->account_active = false;
        }
        $pengajar->save();
    }

    private function checkNotNull(Pengajar $pengajar)
    {
        if (is_null($pengajar->identitas_pengajar))
        {
            return false;
        }
        if (is_null($pengajar->email_pengajar))
        {
            return false;
        }
        if (is_null($pengajar->nama_pengajar))
        {
            return false;
        }
        if (is_null($pengajar->jenisKelamin_pengajar))
        {
            return false;
        }
        if (is_null($pengajar->tanggalLahir_pengajar))
        {
            return false;
        }
        return true;
    }
    
}
