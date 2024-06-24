<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model {

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function lineups()
    {
        return $this->hasMany(Lineup::class);
    }

    public function festivals()
    {
        return $this->hasManyThrough(Festival::class, Lineup::class, 'artist_id', 'id', 'id', 'festival_id');
    }

    public function getImage() {
        return url('/storage/'. $this->image);
    }
}
