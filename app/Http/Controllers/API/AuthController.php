<?php

namespace App\Http\Controllers\API;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request, User $user)
    {
        return $user->saveUser($request)
            ->makeAuthApiToken();
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')
                ->user()
                ->makeAuthApiToken();

            return $user;
        }

        return response()->json(['message' => 'Login Error.....'], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['Success' => 'Logged out'], 200);
    }
}
