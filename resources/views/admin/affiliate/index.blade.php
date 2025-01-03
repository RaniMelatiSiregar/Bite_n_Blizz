@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Affiliate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Affiliate</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Affiliate</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kode Referral</th>
                                    <th>Total Referral</th>
                                    <th>Total Penghasilan</th>
                                    <th>Komisi (%)</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($affiliates as $affiliate)
                                    <tr>
                                        <td>{{ $affiliate->id }}</td>
                                        <td>{{ $affiliate->user->name }}</td>
                                        <td>{{ $affiliate->user->email }}</td>
                                        <td>{{ $affiliate->referral_code }}</td>
                                        <td>{{ $affiliate->referral_count }}</td>
                                        <td>Rp {{ number_format($affiliate->total_earnings, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('admin.affiliate.commission', $affiliate) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group input-group-sm">
                                                    <input type="number" name="commission_rate" 
                                                           value="{{ $affiliate->commission_rate }}" 
                                                           class="form-control" min="0" max="100" required>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-info btn-sm">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.affiliate.toggle', $affiliate) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm 
                                                    {{ $affiliate->is_active ? 'btn-success' : 'btn-danger' }}">
                                                    {{ $affiliate->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.affiliate.show', $affiliate) }}" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data affiliate</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $affiliates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 