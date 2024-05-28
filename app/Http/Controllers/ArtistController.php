<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function store(Request $request) {
        // validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
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
