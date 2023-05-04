<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::All();

        return view('bio.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Redirect back to the user's profile page with a success message
        return redirect()->route('bio.edit', ['bio' => Auth::id()]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('bio.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        info($request->all());

        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'surname' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'country' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'biography' => 'nullable|string',
        ]);

        // Get the user by ID
        $user = User::findOrFail($id);

        $user->fill($validatedData);
        $user->save();

        // Redirect back to the user's profile page with a success message
        return redirect()->route('account')->with('success', 'Profilo aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
    }

    public function updateProfilePicture(Request $request, $id)
    {
        info($request->all());

        $request->validate([
            'profilepic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
        ]);

        $user = User::findOrFail($id);
        $profilePic = $request->file('profilepic');
        $profilePicName = time() . '.' . $profilePic->getClientOriginalExtension();
        $profilePicPath = 'uploads/profile_pictures/';

        // Cancella la vecchia immagine profilo se esiste
        if ($user->profilepic && File::exists(public_path($user->profilepic))) {
            File::delete(public_path($user->profilepic));
        }

        $profilePic->move(public_path($profilePicPath), $profilePicName);

        $user->profilepic = $profilePicPath . $profilePicName;
        $user->save();

        return redirect()->route('account')->with('success', 'Immagine profilo aggiornata con successo!');
    }
}
