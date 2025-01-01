@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <h1>Produk</h1>
        <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Image</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $produk)
                    <tr>
                        <td>{{ $produk->id }}</td>
                        <td>{{ $produk->kode_produk }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $produk->image) }}" alt="Gambar Produk" width="100">
                        </td>
                        <td>{{ $produk->category->name }}</td>
                        <td>{{ $produk->harga }}</td>
                        <td>{{ $produk->qty }}</td>
                        <td>
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
