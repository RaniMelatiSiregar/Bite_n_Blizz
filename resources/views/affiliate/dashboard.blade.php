@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold mb-3">Program Affiliate</h1>
            <p class="lead text-muted">
                Dapatkan komisi 5% dari setiap pembelian yang dilakukan melalui link referral Anda.
                Ajak teman dan keluarga untuk bergabung dan nikmati penghasilan tambahan!
            </p>
            <div class="d-flex gap-3">
                <div class="bg-light rounded-3 p-3 text-center">
                    <h3 class="mb-1">{{ $affiliate->referrals->count() }}</h3>
                    <small class="text-muted">Total Referral</small>
                </div>
                <div class="bg-light rounded-3 p-3 text-center">
                    <h3 class="mb-1">Rp {{ number_format($affiliate->total_commission, 0, ',', '.') }}</h3>
                    <small class="text-muted">Total Komisi</small>
                </div>
                <div class="bg-light rounded-3 p-3 text-center">
                    <h3 class="mb-1">Rp {{ number_format($affiliate->available_balance, 0, ',', '.') }}</h3>
                    <small class="text-muted">Saldo Tersedia</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <i class="fas fa-handshake text-danger" style="font-size: 120px;"></i>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Link Referral Anda</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ route('register') }}?ref={{ $affiliate->referral_code }}" id="referralLink" readonly>
                        <button class="btn btn-primary" type="button" onclick="copyReferralLink()">
                            <i class="fas fa-copy"></i> Salin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="fas fa-share-alt text-danger mb-3" style="font-size: 48px;"></i>
                    <h5 class="card-title">1. Bagikan Link</h5>
                    <p class="card-text text-muted">Bagikan link referral Anda ke teman dan keluarga melalui sosial media atau chat</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="fas fa-user-plus text-danger mb-3" style="font-size: 48px;"></i>
                    <h5 class="card-title">2. Mereka Mendaftar</h5>
                    <p class="card-text text-muted">Teman Anda mendaftar dan berbelanja menggunakan link referral Anda</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="fas fa-money-bill-wave text-danger mb-3" style="font-size: 48px;"></i>
                    <h5 class="card-title">3. Dapatkan Komisi</h5>
                    <p class="card-text text-muted">Anda mendapatkan komisi 5% dari setiap pembelian yang mereka lakukan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Riwayat Referral</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Total Belanja</th>
                                    <th>Komisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($referrals as $referral)
                                    <tr>
                                        <td>{{ $referral->name }}</td>
                                        <td>{{ $referral->email }}</td>
                                        <td>{{ $referral->created_at->format('d M Y') }}</td>
                                        <td>Rp {{ number_format($referral->orders_sum_total_amount ?? 0, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format(($referral->orders_sum_total_amount ?? 0) * 0.05, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada referral</td>
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

@push('scripts')
<script>
function copyReferralLink() {
    var copyText = document.getElementById("referralLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    alert("Link referral berhasil disalin!");
}
</script>
@endpush
@endsection 