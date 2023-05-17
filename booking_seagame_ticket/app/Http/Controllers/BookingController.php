<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function bookingEvent(Request $request)
    {
        $booking = Booking::create([
            'event_id'=>$request->event_id,
            'zone_id'=>$request->zone_id
        ]);
        $events= Event::all();
        $zones = Zone::all();
        $massage_error = "";
        foreach($events as $event){
            foreach($zones as $zone){
                if($event['location_id'] != $zone['location_id']){
                    $massage_error = "This Zone does not exist in this event!";
                }
                elseif(($event['id'] == $booking['event_id']) && ($zone['id'] == $booking['zone_id']) && ($event['location_id'] == $zone['location_id'])){
                    $event_id = $event['id'];
                    $zone_id = $zone['id'];
                    $event_ticket = $event['amount_of_ticket'];
                    $zone_seats = $zone['number_of_seat'];
                    $zone_name = $zone['zone_name'];
                  
                    if(($event_ticket>0) && ($zone_seats>0)){
                        $event_ticket = $event_ticket -1;
                        $zone_seats = $zone_seats -1;
                        DB::update("UPDATE events SET amount_of_ticket = $event_ticket WHERE id = $event_id");
                        DB::update("UPDATE zones SET number_of_seat = $zone_seats WHERE id = $zone_id");
                        return "Booking Success!";
                    }
                    elseif($event_ticket>0 && $zone_seats ==0){
                        DB::delete('DELETE FROM bookings WHERE id=?', [$booking['id']]);
                        return "Zone ". $zone_name . " No Seat Available!";
                    }
                    else{
                        DB::delete('DELETE FROM bookings WHERE id=?', [$booking['id']]);
                        return "No Ticket Available!";
                          
                    }
                } 
            }
        }
        DB::delete('DELETE FROM bookings WHERE id=?', [$booking['id']]);
        return $massage_error;
    }
}

