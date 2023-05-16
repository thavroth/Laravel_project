<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'zone_name',
        'number_of_seat',
        'location_id',
    ];

    public function booking():HasMany{
        return $this->hasMany(Bookings::class);
    }
}
