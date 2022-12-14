<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Person\PutRequest;
use App\Http\Requests\Person\StoreRequest;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Searchable\Search;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //$this->middleware(['role:admin']);
    }

    public function index()

    {
        
        return response()->json(Person::paginate(6));
    }



    public function slug($slug)
    {
        $person = Person::where("slug", $slug)->firstOrFail();
        return response()->json($person);
    }


    public function buildSlug($name)
    {
        return response()->json(Str::slug($name, '-'));
    }

    public function id($slug)
    {
        $person = Person::where("slug", $slug)->firstOrFail();
        $id = $person->id;
        return response()->json($id);
    }

    public function buscar($palabra)
    {
        $searchResults = (new Search())
            ->registerModel(Person::class, 'firstname', 'secondname')
            ->search($palabra);
        return response()->json($searchResults);
    }


    public function store(StoreRequest $request)
    {
        echo ('entrando al store');
        $data = $request->validated();
        return response()->json(Person::create($data));
    }
    public function show(Person $person)
    {
        return response()->json($person);
    }

    public function publicPerson($id)
    {
        $person = Person::where("id", $id)->firstOrFail();
        return response()->json($person);
    }

    

    public function update(PutRequest $request, $slug)
    {

        $person = Person::where("slug", $slug)->firstOrFail();
        $data = $request->validated();
        $person->update($data);
        return response()->json($person);
    }

    public function upload(Request $request, $slug)
    {
        $person = Person::where("slug", $slug)->firstOrFail();
        $data["image"] = $filename = time() . "." . $request["image"]->extension();
        $request->image->move(public_path("image/people"), $filename);

        $person->update($data);
        return response()->json($person);
    }

    public function destroy($slug)
    {
        $person = Person::where("slug", $slug)->firstOrFail();
        $person->delete();
        return response()->json("ok");
    }

    public function delete($slug)
    {
        $person = Person::where("slug", $slug)->firstOrFail();
        $person->delete();
        return response()->json("ok");
    }

    public function getAll()

    {
        //echo(Person::all());
        return response()->json(Person::all());
    }
}
