<?php

namespace App\Http\Controllers;

use App\Models\enums\Roles;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request) {
        // validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phone' => $request->phone,
            'role' => Roles::USER
        ]);

        return response()->json(['success' => true, 'user' => $user], 200);
    }

    public function getOne($id) {
        $user = User::find($id);
        return response()->json(['success' => true, 'user' => $user], 200);
    }

    public function getAll() {
        $users = User::all();
        return response()->json(['success' => true, 'users' => $users], 200);
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => true], 200);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json(['success' => true, 'user' => $user], 200);
    }
}
