<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Festival;
use App\Models\LineUp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FestivalController extends Controller
{
    public function index() {
        $user = Auth::user();
        dd($user);
        $festivals = Festival::all();
        return view('festival.show', compact('festivals'));
    }

    public function details($id) {
        $festival = Festival::find($id);
        $lineup = LineUp::where('festival_id', $id)->get();
        $artists = [];
        foreach ($lineup as $artist) {
            $artists[] = Artist::find($artist->artist_id);
        }

        return view('festival.id', compact('festival', 'artists'));
    }

    // function for creation from WEB
    public function create(Request $request) {
        $validator = $this->verify($request);

        if ($validator) {
            // handle file upload
            $logopath = $request->file('logo') ? $request->file('logo')->store('public/storage/logos') : null;
            $coverpath = $request->file('cover') ? $request->file('cover')->store('public/storage/covers') : null;

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

            return redirect()->route('add-festival')->with('success', 'Festival created successfully!');
        }
    }


    // function for creation from API
    public function store(Request $request) {
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

    public function verify(Request $request) {
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

    public function getOne($id) {
        $festival = Festival::with('artists')->findOrFail($id);
        return response()->json(['success' => true, 'festival' => $festival], 200);
    }

    public function getAll() {
        $festivals = Festival::all();
        return response()->json(['success' => true, 'festivals' => $festivals], 200);
    }

    public function destroy($id) {
        $festival = Festival::find($id);
        $festival->delete();
        return response()->json(['success' => true], 200);
    }

    public function update(Request $request, $id) {
        $festival = Festival::find($id);
        $festival->update($request->all());
        return response()->json(['success' => true, 'user' => $festival], 200);
    }

    public function addToLineup(Request $request, $festival_id) {
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

    public function removeFromLineup(Request $request, $festival_id) {
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
