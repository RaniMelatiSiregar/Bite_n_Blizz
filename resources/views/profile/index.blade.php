<!-- Affiliate Card -->
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-header bg-white py-3">
        <h5 class="card-title mb-0">
            <i class="fas fa-users me-2 text-primary"></i>
            Program Affiliate
        </h5>
    </div>
    <div class="card-body">
        @if(Auth::user()->affiliate)
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Status</p>
                    <h6>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i> Aktif
                        </span>
                    </h6>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Komisi</p>
                    <h6>{{ Auth::user()->affiliate->commission_rate }}%</h6>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Total Referral</p>
                    <h6>{{ Auth::user()->affiliate->referral_count }} orang</h6>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Total Penghasilan</p>
                    <h6>Rp {{ number_format(Auth::user()->affiliate->total_earnings, 0, ',', '.') }}</h6>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('affiliate.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-external-link-alt me-2"></i>
                    Buka Dashboard Affiliate
                </a>
            </div>
        @else
            <div class="text-center py-4">
                <img src="{{ asset('images/affiliate.png') }}" alt="Affiliate" style="height: 120px">
                <h6 class="mt-4">Anda belum bergabung program affiliate</h6>
                <p class="text-muted">Dapatkan penghasilan tambahan dengan merekomendasikan Bite n Blizz</p>
                <a href="{{ route('affiliate.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-handshake me-2"></i>
                    Gabung Sekarang
                </a>
            </div>
        @endif
    </div>
</div> 