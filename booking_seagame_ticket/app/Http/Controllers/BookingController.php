<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
   
    public function bookingEvent(Request $request)
    {
        $booking = Booking::create([
            'event_id'=>$request->event_id
        ]);

        $event= Event::all();
        foreach($event as $event_id){
            if($event_id['id'] == $booking['event_id']){
                $id = $event_id['id'];
                $event_ticket= DB::select('SELECT amount_of_ticket FROM events WHERE id=?', [$id]);
                foreach ($event_ticket as $amount_ticket) {
                    foreach($amount_ticket as $ticket){
                        $number_of_ticket = $ticket;
                        if($number_of_ticket>0){
                            $number_of_ticket = $number_of_ticket -1;
                            DB::update("UPDATE events SET amount_of_ticket =  $number_of_ticket WHERE id = $id");
                            return "Booking Success!";
                            }
                        else{
                            DB::delete('DELETE FROM bookings WHERE event_id=?', [$id]);
                            return "No Ticket Available!";
                        }
                    }
                }
            }  
        }
    
      
      
    }
}
