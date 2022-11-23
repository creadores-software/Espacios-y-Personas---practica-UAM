<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpaceReserves;
use Illuminate\Http\Request;

class SpaceReserveController extends Controller
{
    public function getSpacesReserves($space_id){
        $reserves = SpaceReserves::where("space_id",$space_id)->get();
        return response()->json($reserves);
    }
}
