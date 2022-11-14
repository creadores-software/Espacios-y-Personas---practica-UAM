<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthSanctumController extends Controller
{
    public function registro(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:user',
            'password' => 'required|confirmed',
        ]);

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password= Hash::make($request->password);
        $users->save();
        return response()->json(["mensaje" =>  "Usuario registrado correctamente"],201);
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where("email", "=", $request->email)->first();
        //dd($user);
        if(isset($user)){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken("auth_token")->plainTextToken;
                Session::put('token',$token);
                
                //return response()->json(["mensaje" => "Autenticacion exitosa", "access_token" => $token],201);
                return response()->json(session('token'));
            } else {
                return response()->json(["mensaje" => "Contraseña incorrecta", "error" => true],422);
            }
        } else {
            return response()->json(["mensaje" => "Email inválido.", "error" => true],422);
        }

        // $users = new User();
        // $users->name = $request->name;
        // $users->email = $request->email;
        // $users->password= Hash::make($request->password);
        // $users->save();
        // return response()->json(["mensaje" =>  "Usuario registrado correctamente"],201);
    }

    public function perfil(){
        return Auth::id();
    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json(["status" => 1,"mensaje" =>  "se cerró correctamente"]);
    }
}
