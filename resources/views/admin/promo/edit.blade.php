@extends('admin.layouts.index')
@section('content')
<h1>Edit Voucher</h1>
<form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="code">Code:</label>
    <input type="text" name="code" id="code" value="{{ $voucher->code }}" required>
    <br>
    <label for="discount">Discount:</label>
    <input type="number" name="discount" id="discount" step="0.01" value="{{ $voucher->discount }}" required>
    <br>
    <label for="expiration_date">Expiration Date:</label>
    <input type="date" name="expiration_date" id="expiration_date" value="{{ $voucher->expiration_date }}" required>
    <br>
    <button type="submit">Update</button>
</form>
@endsection
