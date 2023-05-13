<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matching extends Model
{
    use HasFactory;
    protected $fillable = [
        "matching_country",
        "time",
        "matching_description",
        "event_id"
    ];

    public function event():BelongsTo{
        return $this->belongsTo(Event::class);
    }
}
