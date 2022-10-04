<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Personaje;

class PersonajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Personaje::paginate(6));
    }

    public function slug($slug){
        $Personaje = Personaje::where("slug",$slug)->firstOrFail();
        return response()->json($Personaje);
    }

    public function store(Request $request)
    {
        echo('entrando al store');
        $data = $request->validated();          
        return response()->json(Personaje::create($data));
    }

    public function show(Personaje $Personaje)
    {
        return response()->json($Personaje);
    }

    public function update(Request $request, Personaje $Personaje)
    {
        $data = $request->validated();
        $Personaje->update($data);
        return response()->json($Personaje);
    }

    public function destroy($slug){
        $Personaje = Personaje::where("slug",$slug)->firstOrFail();
        $Personaje->delete();
        return response()->json("ok");
    }


}
