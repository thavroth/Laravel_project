<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        "event_name",
        "date",
        "amount_of_ticket",
        "location_id",
    ];

    public function matching():HasMany{
        return $this->hasMany(Matching::class);
    }

    public function booking():HasMany{
        return $this->hasMany(Bookings::class);
    }

   

    public function location():BelongsTo{
        return $this->belongsTo(Location::class);
    }
}
