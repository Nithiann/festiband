<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'cover',
        'start',
        'end',
        'location',
        'ticketPrice'
    ];


    public function artists()
    {
        return $this->hasManyThrough(Artist::class, Lineup::class, 'artist_id', 'id', 'id', 'festival_id');
    }

    public function lineups()
    {
        return $this->hasMany(Lineup::class);
    }

    public function getLogo() {
        return url('/storage/'. $this->logo);
    }

    public function getCover() {
        return url('/storage/'. $this->cover);
    }
}
