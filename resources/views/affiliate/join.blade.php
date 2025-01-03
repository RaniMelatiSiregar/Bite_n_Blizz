@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Program Affiliate Bite n Blizz</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>Bergabunglah dengan Program Affiliate Kami!</h5>
                        <p class="text-muted">Dapatkan komisi untuk setiap referral yang berhasil mendaftar dan melakukan pembelian</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <i class="fas fa-link fa-3x text-danger"></i>
                            </div>
                            <h6>Bagikan Link</h6>
                            <p class="small">Dapatkan link referral unik Anda</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <i class="fas fa-users fa-3x text-danger"></i>
                            </div>
                            <h6>Ajak Teman</h6>
                            <p class="small">Bagikan link ke teman dan keluarga</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <i class="fas fa-money-bill-wave fa-3x text-danger"></i>
                            </div>
                            <h6>Terima Komisi</h6>
                            <p class="small">Dapatkan komisi 5% dari setiap pembelian</p>
                        </div>
                    </div>

                    <div class="alert alert-danger">
                        <h6 class="alert-heading">Keuntungan Program Affiliate:</h6>
                        <ul class="mb-0">
                            <li>Komisi 5% dari setiap pembelian referral</li>
                            <li>Sistem tracking otomatis</li>
                            <li>Pembayaran komisi setiap bulan</li>
                            <li>Dashboard affiliate yang lengkap</li>
                            <li>Dukungan tim support</li>
                        </ul>
                    </div>

                    <form action="{{ route('affiliate.join') }}" method="POST" class="text-center">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-handshake mr-2"></i>
                            Gabung Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
.card-header {
    border-bottom: none;
}
</style>
@endpush 