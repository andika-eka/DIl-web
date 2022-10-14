<?php

namespace App\Http\Controllers\API;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $users = User::all()->where("tipe_pengguna",2);
        return response()->json($users);
    }

    public function indexSiswa()
    {
        $users = User::all()->where("tipe_pengguna",3);
        return response()->json($users);
    }

    public function show($id)
    {
        try
        {
            $user = User::find($id);
        }
        
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e,
                'success' => false,
                'notif'=>'user not found',               
            ], 422);
        }

        if($user->tipe_pengguna == 1)
        {
            return Response()->json($user);
        }
        else
        {
            $detail = $user->detail;
            return Response()->json($user);
        }
    }
}
