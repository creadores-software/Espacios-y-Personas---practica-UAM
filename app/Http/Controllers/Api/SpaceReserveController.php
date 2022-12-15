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

    public function deleteSpaceReserve(Request $request){
        $id = $request['reserve_id'];
        $reserve = SpaceReserves::where("id",$id)->firstOrFail();
        $reserve->delete();
        return response()->json("ok");
    }

    public function setSpacesReserves(Request $request){
        //SpaceReserves::create($request->toArray())
        $date = $request['date'];
        $reserve = $request['reserve'];
        $num_trim = strpos($date, "T");
        $date_trim = substr($date, 0 , $num_trim); 
        $time_trim = substr($date, $num_trim + 1, 8); 

        $reserves = SpaceReserves::where("space_id",$request['space_id'])->get();

        for ($i = 0; $i <= (count($reserves) - 1); $i++) {
            $date_reserve = substr($reserves[$i]['date'], 0 , $num_trim);
            $time_reserve = $reserves[$i]['reserve'];
            if(strcasecmp($date_reserve,$date_trim) == 0){
                if(strcasecmp($time_reserve,$reserve) == 0){
                    echo("Hello");
                    return response()->json("ERROR : Ya hay una reserva con esta fecha y hora");
                } 
            } 
        }
        return response()->json(SpaceReserves::create($request->toArray()));
    }
}
