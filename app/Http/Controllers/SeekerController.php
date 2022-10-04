<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SeekerController extends Controller
{
    public function buscar($palabra){
        $searchResults = (new Search())
        ->registerModel(Person::class, 'firstname','secondname','lastname','secondLastname')
        ->registerModel(Space::class, 'name','description','zone')
        ->search($palabra);
        return response()->json($searchResults);
    }
}
