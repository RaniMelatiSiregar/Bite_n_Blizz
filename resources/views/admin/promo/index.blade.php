@extends('admin.layouts.index')

@section('title', 'Voucher List')

@section('content')
<div class="container">
    <h1>Vouchers</h1>
    <a href="{{ route('vouchers.create') }}" class="btn btn-primary mb-3">Create Voucher</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Discount</th>
                <th>Expiration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->code }}</td>
                <td>{{ $voucher->discount }}</td>
                <td>{{ $voucher->expiration_date }}</td>
                <td>
                    <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this voucher?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
