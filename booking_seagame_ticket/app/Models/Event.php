<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        "event_name",
        "date",
        "time",
        "amount_of_ticket",
        "sport_id",
        "location_id",
    ];
}
