<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function indexAdmin()
    {
        $users = User::all()->where('tipe_pengguna',1);
        return response()->json($users);
    }

    public function indexPengajar()
    {
        $users = User::all()->where('tipe_pengguna',2);
        return response()->json($users);
    }

    public function indexSiswa()
    {
        $users = User::all()->where('tipe_pengguna',3);
        return response()->json($users);
    }

    public function show($id)
    {
        try
        {
            $user = User::find($id);
            if($user->tipe_pengguna == 1)
            {
                return Response()->json($user);
            }
            else
            {
                $user->detail->kelas;
                return Response()->json($user);
            }
        }
        
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
    public function kelas(){
        try{
            $user = Auth::user();
            if($user->tipe_pengguna == 1)
            {
                abort(403);
            }
            $kelas = $user->detail->kelas;
            return response()->json([
                'kelas' =>$kelas,
            ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'notif'=>$e,               
            ], 422);
        } 
    }
    
    public function newPassword(Request $request, $id)
    {
        try
        {
            $user = User::find($id);
            $user->newPassword($request->newPassword);
            
            return response()->json([
                'data' => $user,
                'success' => true,
                'notif'=>'password has been changed',     
            ],200);
            
        }
        catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function updatePassword(Request $request){
        try
        {
            $user = Auth::user();
            $user->newPassword($request->newPassword);
            
            return response()->json([
                'data' => $user,
                'success' => true,
                'notif'=>'password has been changed',     
            ],200);
            
        }
        catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
    
    public function destroy($id)
    {
        try
        {
            $user = User::find($id);
            if ($user->tipe_pengguna == 2)
            {
                $pengajar = Pengajar::find($id);
                $pengajar->delete();
            }
            else if ($user->tipe_pengguna == 3)
            {
                $siswa = Siswa::find($id);
                $siswa->delete();
            }
            $user->delete();
            
            return response()->json([
                'success' => true,
                'notif'=>'user has been deleted',
            ],200);
            
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        } 
    }
}
