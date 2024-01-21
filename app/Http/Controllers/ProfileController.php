<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update user information
        $user->update([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
        ]);

        // Update avatar if a new one is provided
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            Storage::putFileAs('public/avatars', $avatar, $avatarName);

            // Save the avatar path to the User model
            $user->update(['avatar' => 'storage/avatars/' . $avatarName]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}



