<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;


class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::with('user')->get();
        return view('admin.profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.profile.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'skills' => 'nullable',
            'experience' => 'nullable|string',
            'availability' => 'nullable|string',
        ]);

        Profile::create([
            'user_id' => $request->user_id,
            'skills' => json_encode(array_map('trim', explode(', ', $request->skills))),
            'experience' => $request->experience,
            'availability' => $request->availability,
        ]);

        return redirect()->route('profiles.index')->with('succes', 'Profiel aangemaakt');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $users = User::all();
        return view('admin.profile.edit', compact('profile', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'skills' => 'nullable',
            'experience' => 'nullable|string',
            'availability' => 'nullable|string',
        ]);

        $profile->update([
            'user_id' => $request->user_id,
            'skills' => json_encode(array_map('trim', explode(', ', $request->skills))),
            'experience' => $request->experience,
            'availability' => $request->availability,
        ]);

        return redirect()->route('profiles.index')->with('succes', 'Profiel bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('Succes', 'Profiel verwijderd!');
    }
}
