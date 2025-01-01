@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script>
    const name = document.querySelector('#name'); // Ambil input dengan ID 'name'
    const slug = document.querySelector('#slug'); // Ambil input dengan ID 'slug'

    name.addEventListener('change', function() {
        fetch('/dashboard/checkSlug?name=' + name.value) // Gunakan name.value untuk mendapatkan nilai dari input 'name'
        .then(response => response.json())
        .then(data => slug.value = data.slug) // Set nilai slug berdasarkan response JSON
    });

    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })
</script>
@endsection
