<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineUp extends Model {

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
}
