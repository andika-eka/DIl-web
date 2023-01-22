<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\kelas;
use Illuminate\Support\Facades\Auth;
use App\Models\PengambilanKelas;
use App\Models\User;



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
            $account = User::find($user->id);
            $siswa->identitas_siswa  = $request->identitas_siswa;
            $siswa->email_siswa = $request-> email_siswa;
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->jenisKelamin_siswa = $request->jenisKelamin_siswa;
            $siswa->tanggalLahir_siswa = $request->tanggalLahir_siswa;
            $siswa->pathFileFoto_siswa = $request->pathFileFoto_siswa;
            $account->email = $request->email_siswa;
            
            $account->save();
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
                'message' => $e->getMessage(),
                'success' => false,
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
    public function applyKelas($id_kelas)
    {
        try
        {
            $user = Auth::user();
            if ($user->tipe_pengguna != 3)
            {
                throw new \Exception("wrong user type");
            }
            $kelas = Kelas::find($id_kelas);
            $pengambilanKelas = new PengambilanKelas;
            $pengambilanKelas->id_siswa = $user->id;
            $pengambilanKelas->id_kelas = $id_kelas;
            $pengambilanKelas->status_pengambilanKelas = 2;
            $pengambilanKelas->save();
            return response()->json([
                'data' =>  $pengambilanKelas,
                'success' => true,
                'notif'=>'data updated',     
            ],200);
        }
        
        catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
    public function leaveKelas($id_kelas)
    {
        try
        {
            $user = Auth::user();
            if ($user->tipe_pengguna != 3)
            {
                throw new \Exception("wrong user type");
            }
            $pengambilanKelas = PengambilanKelas::where("id_siswa", '=', $user->id)
                                                ->where("id_kelas", "=", $id_kelas)
                                                ->first();
            $pengambilanKelas->delete();
            return response()->json([
                'success' => true,
                'notif'=>' you left kelas',
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

    public function getKelas(){
        try{
            $user = Auth::user();
            if ($user->tipe_pengguna != 3)
            {
                throw new \Exception("wrong user type");
            }
            $kelas = $user->detail->kelas;
            return response()->json([
                'kelas' =>$kelas,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        } 
    }

    public function getApprovedKelas(){
        try{
            $user = Auth::user();
            if ($user->tipe_pengguna != 3)
            {
                throw new \Exception("wrong user type");
            }
            $kelas = $user->detail->approvedKelas();
            return response()->json([
                'kelas' =>$kelas,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        } 
    }
    
}
