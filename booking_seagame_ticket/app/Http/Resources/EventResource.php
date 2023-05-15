<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'event_id'=>$this->id,
            'event_name'=>$this->event_name,
            'date'=>$this->date,
            'amount_of_ticket'=>$this->amount_of_ticket,
            'sport_id'=>$this->sport_id,
            'location_id'=>$this->location_id,
        ];
    }
}
