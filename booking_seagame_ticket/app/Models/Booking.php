<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        "event_id",
        "zone_id",
    ];

    public function event():BelongsTo{
        return $this->belongsTo(Event::class);
    }
    public function zone():BelongsTo{
        return $this->belongsTo(Zone::class);
    }

 

    
}
