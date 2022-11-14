<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Space::paginate(6));
    }

    public function slug($slug){
        $space = Space::where("slug",$slug)->firstOrFail();
        return response()->json($space);
    }


    public function buildSlug($name){
        return response()->json(Str::slug($name, '-'));
    }

    public function id($slug){
        $space = Space::where("slug",$slug)->firstOrFail();
        $id = $space->id;
        return response()->json($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo('entrando al store');        
        return response()->json(Space::create($request->toArray()));
    }

    // public function setOwner(Request $request, $idOwner, $slug){
    //     $space = Space::where("slug",$slug)->firstOrFail();
    //     $space['manager']
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Space $space)
    {
        return response()->json($space);
    }

    public function update(Request $request, $slug)
    {
        $space = Space::where("slug",$slug)->firstOrFail();
        $space->update($request->toArray());
        return response()->json($space);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $space = Space::where("slug",$slug)->firstOrFail();
        $space->delete();
        return response()->json("ok");
    }
}
