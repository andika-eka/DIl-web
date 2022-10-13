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
}
