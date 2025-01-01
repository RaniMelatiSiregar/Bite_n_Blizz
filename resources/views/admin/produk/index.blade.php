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
                        <td>{{ $produk->category->nama_kategori }}</td>
                        <td>{{ $produk->harga }}</td>
                        <td>{{ $produk->qty }}</td>
                        <td>
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
