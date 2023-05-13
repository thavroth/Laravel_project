<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sport extends Model
{
    use HasFactory;
    protected $fillable=[
        "sport_name",
        "player_type"
        
    ];
    
    public function event():HasMany{
        return $this->hasMany(Event::class);
    }
}
