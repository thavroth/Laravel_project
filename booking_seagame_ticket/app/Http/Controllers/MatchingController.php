<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Matching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matching = Matching::all();
        return response()->json(['success'=>true, 'data'=>$matching], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'matching_country'=> 'required',
            'time'=>'required|max:5',
            'matching_description'=>'nullable',
            'sport_id'=>'required',
            'event_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false, 'error'=>$validator->errors()],422);
        }
        else{
            $matching = Matching::create([
                'matching_country'=> $request -> matching_country,
                'time' => $request -> time,
                'matching_description' => $request -> matching_description,
                'sport_id'=>$request -> sport_id,
                'event_id' => $request -> event_id
            ]);
            return response()->json(['success'=>true, 'data'=>$matching], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $matching = Event::find($id)->matching;
        return response()->json(['success'=>true, 'data'=>$matching], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'matching_country'=> 'required',
            'time'=>'required|max:5',
            'matching_description'=>'nullable',
            'sport_id'=>'required',
            'event_id'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'massage' => $validator->errors()],422);
        }
        else{
            $matching = Matching::find($id)->update([
                'matching_country'=> $request -> matching_country,
                'time' => $request -> time,
                'matching_description' => $request -> matching_description,
                'sport_id'=> $request->sport_id,
                'event_id' => $request -> event_id
        ]);
        return response()->json(['success' => true, 'data' =>  $matching],200);
        }
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matching = Matching::find($id);
        $matching->delete();
        return response()->json(['success'=>true, 'message'=>"Delete matching succesfully"], 200);
    }
}
