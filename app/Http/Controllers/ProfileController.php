<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Tampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('public.profile.edit', compact('user'));
    }

    // Proses pembaruan profil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email', 'phone', 'address'));

        return redirect()->route('public.profile.index')->with('success', 'Profile updated successfully.');
    }
}
