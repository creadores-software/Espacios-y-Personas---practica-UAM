<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryPerson;
use App\Models\Person;
use App\Models\CategoryPersonField;

class CategoryPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = CategoryPerson::all();
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoryPerson)
    {
        $category = CategoryPerson::find($categoryPerson);
        return response()->json($category->fields);
    }

    public function getPersonCategoriesFields($person_id)
    {
        $fields = CategoryPersonField::where("owner",$person_id)->where('category_person_id',1)->get();
        return response()->json($fields);
    }

    public function getWorkCategoriesFields($person_id)
    {
        $fields = CategoryPersonField::where("owner",$person_id)->where('category_person_id',2)->get();
        return response()->json($fields);
    }

    public function getPersonCategories(){
        $categories = CategoryPerson::where("name",'Personal')->get();
        return response()->json($categories);
    }

    public function getWorkCategories(){
        $categories = CategoryPerson::where("name",'Laboral')->get();
        return response()->json($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
