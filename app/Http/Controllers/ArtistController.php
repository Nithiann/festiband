<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Festival;
use App\Models\LineUp;

class ArtistController extends Controller
{
    public function index() {
        $artists = Artist::all();
        return view('festival.list', compact('artists'));
    }

    public function details($id) {
        $artist = Artist::find($id);
        $lineup = LineUp::where('artist_id', $id)->get();
        $festivals = [];
        foreach ($lineup as $festival) {
            $festivals[] = Festival::find($festival->festival_id);
        }

        return view('festival.id', compact('artist', 'festivals'));
    }

    public function store(Request $request) {
        // validation
        $request->validate([
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:255',
            'image' => 'image',
        ]);

        $artist = Artist::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return response()->json(['success' => true, 'user' => $artist], 200);
    }

    public function getOne($id) {
        $artist = Artist::find($id);
        return response()->json(['success' => true, 'user' => $artist], 200);
    }

    public function getAll() {
        $artist = Artist::all();
        return response()->json(['success' => true, 'users' => $artist], 200);
    }

    public function destroy($id) {
        $artist = Artist::find($id);
        $artist->delete();
        return response()->json(['success' => true], 200);
    }

    public function update(Request $request, $id) {
        $artist = Artist::find($id);
        $artist->update($request->all());
        return response()->json(['success' => true, 'user' => $artist], 200);
    }
}
