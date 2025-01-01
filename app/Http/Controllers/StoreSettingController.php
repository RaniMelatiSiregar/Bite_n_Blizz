<?php

namespace App\Http\Controllers;

use App\Models\StoreSetting;
use Illuminate\Http\Request;

class StoreSettingController extends Controller
{
    // Menampilkan daftar pengaturan toko
    public function index()
    {
        $storeSettings = StoreSetting::all();
        return view('admin.storeSettings.index', compact('storeSettings'));
    }

    // Menampilkan form untuk membuat pengaturan toko baru
    public function create()
    {
        return view('admin.storeSettings.create');
    }

    // Menyimpan pengaturan toko baru
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email',
            'store_phone' => 'required|string',
        ]);

        StoreSetting::create($request->all());
        return redirect()->route('store-settings.index')->with('success', 'Pengaturan Toko berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit pengaturan toko
    public function edit(StoreSetting $storeSetting)
    {
        return view('admin.storeSettings.edit', compact('storeSetting'));
    }

    // Menyimpan perubahan pengaturan toko
    public function update(Request $request, StoreSetting $storeSetting)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email',
            'store_phone' => 'required|string',
        ]);

        $storeSetting->update($request->all());
        return redirect()->route('store-settings.index')->with('success', 'Pengaturan Toko berhasil diperbarui.');
    }

    // Menghapus pengaturan toko
    public function destroy(StoreSetting $storeSetting)
    {
        $storeSetting->delete();
        return redirect()->route('store-settings.index')->with('success', 'Pengaturan Toko berhasil dihapus.');
    }
}
