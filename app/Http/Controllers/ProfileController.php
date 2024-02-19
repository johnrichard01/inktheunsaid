<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate and update profile fields
        $request->validate([
            'new_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'max:255',
            'city' => 'max:255',
        ]);

        // Handle new avatar upload
        if ($request->hasFile('new_avatar')) {
            // Delete existing avatar
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Upload new avatar
            $avatarPath = $request->file('new_avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update other fields individually
        $user->bio = $request->input('bio');
        $user->username = $request->input('username');
        $user->gender = $request->input('gender');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->city = $request->input('city');

        $user->update();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function show($username)
    {
        $user = User::where('username', $username)->with('posts')->firstOrFail();
        return view('profile', ['user' => $user]);
    }
}
