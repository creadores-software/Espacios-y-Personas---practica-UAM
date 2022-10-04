<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Space;

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
