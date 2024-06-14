<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Festival;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function FestivalIndex() {
        $festivals = Festival::all();
        return view('festival.admin.admin-list', compact('festivals'));
    }

    public function ArtistIndex() {
        $artists = Artist::all();
        return view('artist.admin.admin-list', compact('artists'));
    }
}
