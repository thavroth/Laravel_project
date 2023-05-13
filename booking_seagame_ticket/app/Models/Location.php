<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        "location",
        "zone",
        "floor"
    ];

    public function event():HasMany{
        return $this->hasMany(Event::class);
    }
}
