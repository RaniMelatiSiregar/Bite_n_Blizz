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
        // Validasi input
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'slug' => 'required|unique:produk',
            'image' => 'nullable|image',
            'deskripsi_produk' => 'required|string',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);

        // Menyimpan file gambar jika ada
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('public/produk-images');
        }

        // Menyimpan data produk
        Produk::create($validatedData);

        // Redirect kembali dengan pesan sukses
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
        // Validasi input
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

        // Menemukan produk berdasarkan ID
        $produk = Produk::findOrFail($id);
        $data = $request->all();

        // Jika ada file gambar baru, hapus gambar lama dan simpan gambar baru
        if ($request->hasFile('image')) {
            if ($produk->image) {
                Storage::delete($produk->image);
            }
            $data['image'] = $request->file('image')->store('public/produk-images');
        }

        // Update data produk
        $produk->update($data);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->image) {
            Storage::delete($produk->image);
        }

        // Hapus produk
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
