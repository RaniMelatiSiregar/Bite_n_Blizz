<?php

namespace App\Http\Controllers;

use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreSettingController extends Controller
{
    public function index()
    {
        $storeSetting = StoreSetting::first();
        return view('admin.store-settings.index', compact('storeSetting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string',
            'store_email' => 'required|email',
            'store_phone' => 'required|string',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except(['store_logo', 'store_banner']);

        // Handle logo upload
        if ($request->hasFile('store_logo')) {
            $data['store_logo'] = $request->file('store_logo')->store('store/logo', 'public');
        }

        // Handle banner upload
        if ($request->hasFile('store_banner')) {
            $data['store_banner'] = $request->file('store_banner')->store('store/banner', 'public');
        }

        StoreSetting::create($data);

        return redirect()->route('store-settings.index')
            ->with('success', 'Pengaturan toko berhasil disimpan');
    }

    public function update(Request $request, StoreSetting $storeSetting)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string',
            'store_email' => 'required|email',
            'store_phone' => 'required|string',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except(['store_logo', 'store_banner']);

        // Handle logo upload
        if ($request->hasFile('store_logo')) {
            // Delete old logo
            if ($storeSetting->store_logo) {
                Storage::disk('public')->delete($storeSetting->store_logo);
            }
            $data['store_logo'] = $request->file('store_logo')->store('store/logo', 'public');
        }

        // Handle banner upload
        if ($request->hasFile('store_banner')) {
            // Delete old banner
            if ($storeSetting->store_banner) {
                Storage::disk('public')->delete($storeSetting->store_banner);
            }
            $data['store_banner'] = $request->file('store_banner')->store('store/banner', 'public');
        }

        $storeSetting->update($data);

        return redirect()->route('store-settings.index')
            ->with('success', 'Pengaturan toko berhasil diperbarui');
    }
}
