<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Produk',
            'produk' => Produk::with('category')->get()
        ];
        return view('admin.produk.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'categories' => Category::all()
        ];
        return view('admin.produk.create', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'kode_produk' => 'required|unique:produks',
            'nama_produk' => 'required',
            'slug' => 'required|unique:produks',
            'image' => 'image|file|max:1024',
            'deskripsi_produk' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('produk-images');
        }

        Produk::create($validatedData);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // Show edit form
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $categories = Category::all();
        return view('admin.produk.edit', compact('produk', 'categories'))->with('title', 'Edit Product');
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categoris,id',
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'slug' => 'required|unique:produk,slug,' . $id,
            'image' => 'nullable|image',
            'deskripsi_produk' => 'required|string',
            'qty' => 'required|numeric',
            'satuan' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produk_images', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Delete produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
