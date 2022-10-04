<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials)){
            $token = Auth::user()->createToken('myapptoken')->plainTextToken;

            return response()->json($token);
        }

        return response()->json("usuario y/o contraseña invalido");
    }
}
