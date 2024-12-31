<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return redirect()->route('profile.edit');
    }

    public function edit()
    {
        $query = Order::where('user_id', Auth::id());
        
        // Filter berdasarkan status
        if (request()->has('status')) {
            $query->where('status', request()->status);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();
        
        // Hitung jumlah pesanan yang perlu dikirim
        $pendingCount = Order::where('user_id', Auth::id())
                            ->where('status', 'pending')
                            ->count();

        return view('public.profile.edit', compact('orders', 'pendingCount'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            
            // Store new photo
            $photo = $request->file('photo');
            $photoPath = $photo->store('profile-photos', 'public');
            
            // Update user with new photo
            $user->update(array_merge(
                $request->only(['name', 'email', 'phone', 'address']),
                ['photo' => $photoPath]
            ));
        } else {
            // Update user without photo
            $user->update($request->only(['name', 'email', 'phone', 'address']));
        }

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }
}
