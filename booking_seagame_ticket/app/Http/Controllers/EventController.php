<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EventResource as ResourcesEventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event_name = request('event_name');
        $event = Event::all();
        $event = Event::where('event_name','like','%'.$event_name.'%')->get();
        $event = ResourcesEventResource::collection($event);
        return response()->json(['success'=> true, 'data'=>$event],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'event_name'=> 'required|max:500',
            'date'=>'required|max:20',
            'amount_of_ticket'=>'required|max:4',
            'location_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false,'error'=>$validator->errors()],422);
        }
        else{
            $event = Event::create([
                'event_name'=>$request->event_name,
                'date'=>$request->date,
                'amount_of_ticket'=>$request->amount_of_ticket,
                'location_id'=>$request->location_id
            ]);
            return response()->json(['success'=>true,'data'=>$event],200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::find($id);
        return response()->json(['success'=>true,'data'=>$event],200);
    }

    public function findEventLocation($id){
        $location = Event::find($id)->location;
        return response()->json(['success'=>true,'data'=>$location],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'event_name'=> 'required|max:500',
            'date'=>'required|max:20',
            'amount_of_ticket'=>'required|max:4',
            'location_id'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'massage' => $validator->errors()],422);
        }
        else{
            $event = Event::find($id)->update([
                'event_name'=>$request->event_name,
                'date'=>$request->date,
                'amount_of_ticket'=>$request->amount_of_ticket,
                'location_id'=>$request->location_id,
        ]);
        return response()->json(['success' => true, 'data' => $event],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['success'=>true],200);
    }
}
