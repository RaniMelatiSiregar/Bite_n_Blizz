@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <h1>Tambah Produk</h1>
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_produk">Kode Produk</label>
                <input type="text" name="kode_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="qty">Jumlah Stok</label>
                <input type="number" name="qty" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" name="satuan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
