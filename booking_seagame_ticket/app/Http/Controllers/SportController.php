<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sport = Sport::all();
        return response()->json(['success'=> true, 'data'=>$sport],200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'sport_name' =>'required|max:255',
            'player_type' =>'required|max:10',

        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'massage' => $validator->errors()],422);
        }       
        else{
        $sport = Sport::create([
            'sport_name' => $request->sport_name,
            'player_type' => $request->player_type,
           
        ]);
        return response()->json(['success' => true, 'data' => $sport],200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Sport::find($id)->event;
        return response()->json(['success' => true, 'data' => $event],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sport_name' =>'required|max:255',
            'player_type' =>'required|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'massage' => $validator->errors()],422);
        }
        else{
            $sport = Sport::find($id)->update([
            'sport_name' => $request->sport_name,
            'player_type' => $request->player_type,
        ]);
        return response()->json(['success' => true, 'data' => $sport],200);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sport = Sport::find($id);
        $sport->delete();
        return response()->json(['success' => true, 'data' => $sport],200);
    }
}
