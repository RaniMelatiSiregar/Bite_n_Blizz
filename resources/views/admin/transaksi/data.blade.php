@extends('admin.layouts.index')

@section('content')

    <h1>Data Transaksi</h1>
    <div>
        <p>Perlu Diproses: {{ $countPerluDiproses }}</p>
        <p>Telah Diproses: {{ $countTelahDiproses }}</p>
        <p>Tertunda: {{ $countTertunda }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaksi)
                <tr>
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->order_id }}</td>
                    <td>{{ $transaksi->status }}</td>
                    <td>
                        <!-- Tindakan lainnya -->
                        <a href="#">Lihat Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $transactions->links() }}
@endsection
