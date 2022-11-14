<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryField\StoreRequest;
use Illuminate\Http\Request;
use App\Models\CategoryPersonField;

class CategoryPersonFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesFields = CategoryPersonField::all();
        return response()->json($categoriesFields);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {           
        $data = $request->validated(); 
        return response()->json(CategoryPersonField::create($data));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoryPerson)
    {
        $category = CategoryPersonField::find($categoryPerson);
        return response()->json($category->fields);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_user)
    {
        session()->regenerate();
        $name = $request["name"];
        $category = CategoryPersonField::where("name",$name)->where("owner",$id_user)->firstOrFail();
        //$data = $request->validated();
        $category->update($request->toArray());
        return response()->json($category);
    }


    /**
     * Remove the specified resource from storage.e
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function eliminarCategoriasPersonal(Request $request, $id_user){
        try {
            CategoryPersonField::where("owner",$id_user)->where("category_person_id",1)->delete();
            return response()->json("Hello" + CategoryPersonField::where("owner",$id_user)->where("category_person_id",1));
        } catch (\Throwable $th) {
            return response()->json($th);
        }
         
           
    }

    public function eliminarCategoriasLaboral(Request $request, $id_user){
        try {
            CategoryPersonField::where("owner",$id_user)->where("category_person_id",2)->delete();
            return response()->json("Hello" + CategoryPersonField::where("owner",$id_user)->where("category_person_id",1));
        } catch (\Throwable $th) {
            return response()->json($th);
        }     
     }
}
