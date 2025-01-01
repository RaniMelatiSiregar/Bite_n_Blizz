@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <h1>Edit Pengaturan Toko</h1>
        <form action="{{ route('store-settings.update', $storeSetting->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="store_name" class="form-label">Nama Toko</label>
                <input type="text" name="store_name" id="store_name" class="form-control" value="{{ $storeSetting->store_name }}" required>
            </div>
            <div class="mb-3">
                <label for="store_email" class="form-label">Email</label>
                <input type="email" name="store_email" id="store_email" class="form-control" value="{{ $storeSetting->store_email }}" required>
            </div>
            <div class="mb-3">
                <label for="store_phone" class="form-label">Telepon</label>
                <input type="text" name="store_phone" id="store_phone" class="form-control" value="{{ $storeSetting->store_phone }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
@endsection
