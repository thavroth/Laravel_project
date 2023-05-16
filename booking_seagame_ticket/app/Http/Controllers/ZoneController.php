<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zone = Zone::all();
        return response()->json(['success'=>true, 'data'=>$zone], 200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'zone_name'=> 'required|unique:zones',
            'number_of_seat'=> 'required',
            'location_id'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false, 'error'=>$validator->errors()],422);
        }
        else{
            $zone = Zone::create([
                'zone_name'=> $request -> zone_name,
                'number_of_seat'=>$request->number_of_seat,
                'location_id' => $request -> location_id
            ]);
            return response()->json(['success'=>true, 'data'=>$zone], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $zone = Location::find($id)->zone;
        return response()->json(['success'=>true, 'data'=>$zone], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'zone_name'=> 'required',
            'number_of_seat'=> 'required',
            'location_id'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false, 'error'=>$validator->errors()],422);
        }
        else{
            $zone = Zone::find($id)->update([
                'zone_name'=> $request -> zone_name,
                'number_of_seat'=>$request->number_of_seat,
                'location_id' => $request -> location_id
            ]);
            return response()->json(['success'=>true, 'data'=>$zone], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $zone = Zone::find($id)->delete();
        return response()->json(['success'=>true, 'data'=>$zone], 200);
    }
}
