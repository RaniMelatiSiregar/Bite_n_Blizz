@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Affiliate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.affiliate.index') }}">Affiliate</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="https://ui-avatars.com/api/?name={{ urlencode($affiliate->user->name) }}&background=random"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $affiliate->user->name }}</h3>
                            <p class="text-muted text-center">{{ $affiliate->user->email }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Total Referral</b> <span class="float-right">{{ $affiliate->referral_count }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Penghasilan</b> <span class="float-right">Rp {{ number_format($affiliate->total_earnings, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Saldo Tersedia</b> <span class="float-right">Rp {{ number_format($affiliate->available_balance, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Komisi</b> <span class="float-right">{{ $affiliate->commission_rate }}%</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> 
                                    <span class="float-right badge {{ $affiliate->is_active ? 'badge-success' : 'badge-danger' }}">
                                        {{ $affiliate->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <h3 class="card-title">Daftar Referral</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Bergabung</th>
                                            <th>Total Pembelian</th>
                                            <th>Komisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($affiliate->user->referrals as $referral)
                                            <tr>
                                                <td>{{ $referral->name }}</td>
                                                <td>{{ $referral->email }}</td>
                                                <td>{{ $referral->created_at->format('d M Y') }}</td>
                                                <td>Rp {{ number_format($referral->orders_sum_total ?? 0, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format(($referral->orders_sum_total ?? 0) * $affiliate->commission_rate / 100, 0, ',', '.') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data referral</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 