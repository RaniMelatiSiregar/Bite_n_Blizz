@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <h1>Tambah Produk</h1>

        <!-- Menampilkan error validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form tambah produk -->
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_produk">Kode Produk</label>
                <input type="text" name="kode_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                <img id="imagePreview" src="#" alt="Gambar Preview" style="display: none; width: 100px; margin-top: 10px;">
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

<script>
    const nama_produk = document.querySelector('#nama_produk'); // Ambil input dengan ID 'nama_produk'
    const slug = document.querySelector('#slug'); // Ambil input dengan ID 'slug'

    nama_produk.addEventListener('change', function() {
        fetch('/produks/checkSlug?nama_produk=' + nama_produk.value) // Gunakan name.value untuk mendapatkan nilai dari input 'name'
        .then(response => response.json())
        .then(data => slug.value = data.slug) // Set nilai slug berdasarkan response JSON
    });

    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })

    // Fungsi preview gambar
    function previewImage(event) {
        var output = document.getElementById('imagePreview');
        output.style.display = 'block';
        output.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection
