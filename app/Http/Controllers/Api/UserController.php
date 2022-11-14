<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

            Session::put('token', $token);

            //session()->regenerate();
            
            return response()->json([
                'isLoggedIn' => true,
                'user' => auth()->user(),
                'token' => $token,
            ]);
        }

        return response()->json("usuario y/o contraseña invalido");
    }
}
