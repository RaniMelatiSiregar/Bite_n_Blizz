<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function index()
    {
        $affiliates = Affiliate::with('user')->paginate(10);
        return view('admin.affiliate.index', compact('affiliates'));
    }

    public function show(Affiliate $affiliate)
    {
        $affiliate->load(['user', 'user.referrals']);
        return view('admin.affiliate.show', compact('affiliate'));
    }

    public function updateCommission(Request $request, Affiliate $affiliate)
    {
        $request->validate([
            'commission_rate' => 'required|numeric|min:0|max:100'
        ]);

        $affiliate->update([
            'commission_rate' => $request->commission_rate
        ]);

        return back()->with('success', 'Komisi affiliate berhasil diperbarui');
    }

    public function toggleStatus(Affiliate $affiliate)
    {
        $affiliate->update([
            'is_active' => !$affiliate->is_active
        ]);

        $status = $affiliate->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Affiliate berhasil {$status}");
    }

    public function withdrawals()
    {
        // Implementasi daftar permintaan penarikan
        return view('admin.affiliate.withdrawals');
    }

    public function approveWithdrawal($withdrawalId)
    {
        // Implementasi persetujuan penarikan
        return back()->with('success', 'Penarikan berhasil disetujui');
    }

    public function rejectWithdrawal($withdrawalId)
    {
        // Implementasi penolakan penarikan
        return back()->with('success', 'Penarikan berhasil ditolak');
    }
} 