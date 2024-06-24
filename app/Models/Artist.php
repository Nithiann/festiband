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

    public function festival() {
        return $this->hasMany(Festival::class, 'lineup');
    }

    public function portfolio() {
        return $this->hasMany(Festival::class, 'portfolio');
    }

    public function getImage() {
        return url('/storage/'. $this->image);
    }
}
