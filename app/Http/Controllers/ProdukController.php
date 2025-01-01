<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    // Show all produk
    public function index()
    {
        $produk = Produk::with('category')->get();
        return view('admin.produk.index', compact('produk'))->with('title', 'Setting Product');
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.produk.create', compact('categories'))->with('title', 'Create New Product');
    }

    // Store produk
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'slug' => 'required|unique:produk',
            'image' => 'nullable|image',
            'deskripsi_produk' => 'required|string',
            'qty' => 'required|numeric',
            'satuan' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $data = $request->all();

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produk_images', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
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
            'category_id' => 'required|exists:categories,id',
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

    public function checkSlug(Request $request)
    {
        // Ambil data 'name' dari query string
        $nama_produk = $request->input('nama_produk');
        
        // Buat slug dari 'nama_produk'
        $slug = Str::slug($nama_produk);

        // Kirimkan hasil slug dalam bentuk JSON
        return response()->json(['slug' => $slug]);
    }
}
