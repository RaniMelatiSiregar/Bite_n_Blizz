<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'category_id' => 'required|exists:categories,id',
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'slug' => 'required|unique:produks',
            'image' => 'nullable|image',
            'deskripsi_produk' => 'required|string',
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

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $categories = Category::all();
        return view('admin.produk.edit', compact('produk', 'categories'))->with('title', 'Edit Product');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'slug' => 'required|unique:produks,slug,' . $id,
            'image' => 'nullable|image',
            'deskripsi_produk' => 'required|string',
            'qty' => 'required|numeric',
            'satuan' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if($produk->image) {
                Storage::delete($produk->image);
            }
            $data['image'] = $request->file('image')->store('produk-images');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        
        if($produk->image) {
            Storage::delete($produk->image);
        }
        
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function checkSlug(Request $request)
    {
        $nama_produk = $request->input('nama_produk');
        $slug = Str::slug($nama_produk);
        return response()->json(['slug' => $slug]);
    }
}
