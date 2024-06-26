<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineup extends Model {

    use HasFactory;

    protected $fillable = [
        'set_name',
        'start_time',
        'end_time',
        'artist_id',
        'festival_id'
    ];

    protected $hidden = [

    ];

    public function festival() {
        return $this->belongsTo(Festival::class);
    }

    public function artist() {
        return $this->belongsTo(Artist::class);
    }
}
