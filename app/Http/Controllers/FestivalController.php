<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Festival;
use App\Models\LineUp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FestivalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $festivals = Festival::all();
        return view('festival.show', compact('festivals'));
    }

    public function details($id)
    {
        $festival = Festival::find($id);
        $lineup = LineUp::where('festival_id', $id)->get();
        $artists = [];
        foreach ($lineup as $artist) {
            $artists[] = Artist::find($artist->artist_id);
        }

        return view('festival.id', compact('festival', 'artists', 'lineup'));
    }

    public function edit($id)
    {
        $festival = Festival::findOrFail($id);
        return view('admin.festivals.edit', compact('festival'));
    }

    public function lineupPage(Festival $festival)
    {
        $allArtists = Artist::all();
        $currentLineup = Lineup::where('festival_id', $festival->id)->get()->map(function ($lineup) {
            $lineup->artist_name = Artist::find($lineup->artist_id)->name;
            return $lineup;
        });

        return view('festival.admin.admin-lineup', compact('festival', 'allArtists', 'currentLineup'));
    }

    public function submitLineup(Request $request, Festival $festival)
    {
        $lineupData = json_decode($request->input('lineup'), true);

        Lineup::where('festival_id', $festival->id)->delete();

        foreach ($lineupData as $lineupItem) {
            $lineupItem['festival_id'] = $festival->id;
            Lineup::create([
                'artist_id' => $lineupItem['artist_id'],
                'set_name' => $lineupItem['set_name'],
                'festival_id' => $festival->id,
            ]);
        }

        return redirect()->route('festival-admin-list')->with('success', 'Lineup updated successfully.');
    }

    // function for creation from WEB
    public function create(Request $request)
    {
        $validator = $this->verify($request);

        if ($validator) {
            // handle file upload
            $logopath = $request->file('logo') ? $request->file('logo')->store('logos', 'public') : null;
            $coverpath = $request->file('cover') ? $request->file('cover')->store('covers', 'public') : null;

            $festival = Festival::create([
                'name' => $request->name,
                'description' => $request->description,
                'logo' => $logopath,
                'cover' => $coverpath,
                'start' => $request->start,
                'end' => $request->end,
                'location' => $request->location,
                'ticketPrice' => $request->ticketPrice,
            ]);

            return redirect()->route('admin.festival.create')->with('success', 'Festival created successfully!');
        }
    }


    // function for creation from API
    public function store(Request $request)
    {
        try {
            $validator = $this->verify($request);

            if ($validator) {
                $festival = Festival::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'logo' => $request->logo,
                    'cover' => $request->cover,
                    'start' => $request->start,
                    'end' => $request->end,
                    'location' => $request->location,
                    'ticketPrice' => $request->ticketPrice,
                ]);

                return response()->json(['success' => true, 'festival' => $festival], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:255',
            'logo' => 'image',
            'cover' => 'image',
            'start' => 'required',
            'end' => 'required',
            'location' => 'required',
            'ticketPrice' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return true;
    }

    public function getOne($id)
    {
        $festival = Festival::with('artists')->findOrFail($id);
        return response()->json(['success' => true, 'festival' => $festival], 200);
    }

    public function getAll()
    {
        $festivals = Festival::all();
        return response()->json(['success' => true, 'festivals' => $festivals], 200);
    }

    public function destroy($id)
    {
        $festival = Festival::find($id);
        $festival->delete();
        return redirect()->route('festival-admin-list');
    }

    public function update(Request $request, $id)
    {
        $festival = Festival::find($id);
        $festival->update($request->all());
        return response()->json(['success' => true, 'user' => $festival], 200);
    }

    public function addToLineup(Request $request, $festival_id)
    {
        try {
            $artist = Artist::find($request->artist_id);
            $festival = Festival::find($festival_id);

            if ($request->set_name) {
                $festival->artists()->attach($artist, ['set_name' => $request->set_name]);
            } else {
                $festival->artists()->attach($artist);
            }

            return response()->json(['success' => true, 'message' => 'added to Line-up'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function removeFromLineup(Request $request, $festival_id)
    {
        try {
            $festival = Festival::find($festival_id);
            $artist = Artist::find($request->artist_id);

            $festival->artists()->detach($artist);

            return response()->json(['success' => true, 'message' => 'removed from Line-up'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
