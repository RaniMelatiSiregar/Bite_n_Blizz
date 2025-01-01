@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1>Create Voucher</h1>
    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf
        
        <!-- Code Input -->
        <div class="mb-3">
            <label for="code" class="form-label">Code:</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required>
            @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Discount Input -->
        <div class="mb-3">
            <label for="discount" class="form-label">Discount:</label>
            <input type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror" step="0.01" value="{{ old('discount') }}" required>
            @error('discount')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Expiration Date Input -->
        <div class="mb-3">
            <label for="expiration_date" class="form-label">Expiration Date:</label>
            <input type="date" name="expiration_date" id="expiration_date" class="form-control @error('expiration_date') is-invalid @enderror" value="{{ old('expiration_date') }}" required>
            @error('expiration_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Voucher</button>
    </form>
</div>

<script>
    // Optional: Implement any additional JavaScript functionality if needed
</script>
@endsection
