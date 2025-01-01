@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <h1>Buat Pengaturan Toko</h1>
        <form action="{{ route('store-settings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="store_name" class="form-label">Nama Toko</label>
                <input type="text" name="store_name" id="store_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="store_email" class="form-label">Email</label>
                <input type="email" name="store_email" id="store_email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="store_phone" class="form-label">Telepon</label>
                <input type="text" name="store_phone" id="store_phone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
