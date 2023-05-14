<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
   
    public function bookingEvent($id)
    {
        $id = Event::find($id) ->id;
        $data= DB::select('SELECT amount_of_ticket FROM events WHERE id=?', [$id]);
        foreach ($data as $item) {
            foreach($item as $event_ticket){
            $amount_of_ticket = $event_ticket;
            if($amount_of_ticket>0){
               DB::insert("INSERT INTO bookings (event_id) VALUES ($id)");
               $amount_of_ticket = $amount_of_ticket -1;
               DB::update("UPDATE events SET amount_of_ticket =  $amount_of_ticket WHERE id = $id");
               return "Booking Success!";
            }
            else{
                return "No Ticket Available!";
            }
        }
        }
    }
}
