@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <h1>Daftar Pengaturan Toko</h1>
        <a href="{{ route('store-settings.create') }}" class="btn btn-primary">Buat Pengaturan Toko</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nama Toko</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($storeSettings as $setting)
                    <tr>
                        <td>{{ $setting->store_name }}</td>
                        <td>{{ $setting->store_email }}</td>
                        <td>{{ $setting->store_phone }}</td>
                        <td>
                            <a href="{{ route('store-settings.edit', $setting->id) }}" class="btn btn-warning">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('store-settings.destroy', $setting->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-regular fa-trash-can"></i> 
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
