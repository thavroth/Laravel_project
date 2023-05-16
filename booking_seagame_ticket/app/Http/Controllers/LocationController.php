<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $location = Location::all();
        return response()->json(['success'=> true, 'data'=>$location],200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'location' => 'required|max:255|unique:locations',
            'floor' =>'nullable|max:10'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'massage' => $validator->errors()],422);
        }
        else{
            $sport = Location::create([
                'location' => $request->location,
                'floor' => $request->floor
               
            ]);
            return response()->json(['success' => true, 'data' => $sport],200);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Location::find($id)->event;
        return response()->json(['success' => true, 'data' => $event],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required|max:255',
            'floor' =>'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'massage' => $validator->errors()],422);
        }
        else{
            $location = Location::find($id)->update([
                'location' => $request->location,
                'floor' => $request->floor
        ]);
        return response()->json(['success' => true, 'data' =>  $location],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();
        return response()->json(['success'=>true, 'data'=>$location],200);
    }
}
