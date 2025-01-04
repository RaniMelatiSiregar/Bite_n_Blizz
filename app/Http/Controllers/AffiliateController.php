<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $affiliate = $user->affiliate;
        
        if (!$affiliate) {
            return view('affiliate.join');
        }
        
        $referrals = $user->referrals()->with('affiliate')->get();
        return view('affiliate.dashboard', compact('affiliate', 'referrals'));
    }

    public function join()
    {
        $user = Auth::user();
        
        // Cek jika user sudah punya affiliate
        if ($user->affiliate) {
            return redirect()->route('affiliate.dashboard')
                ->with('error', 'Anda sudah terdaftar sebagai affiliate');
        }

        // Generate unique referral code
        do {
            $referralCode = strtoupper(Str::random(8));
        } while (Affiliate::where('referral_code', $referralCode)->exists());

        // Buat affiliate baru
        $affiliate = Affiliate::create([
            'user_id' => $user->id,
            'referral_code' => $referralCode,
            'commission_rate' => 5.00, // Default 5%
        ]);

        return redirect()->route('affiliate.dashboard')
            ->with('success', 'Selamat! Anda telah berhasil bergabung sebagai affiliate');
    }

    public function withdraw(Request $request)
    {
        $user = Auth::user();
        $affiliate = $user->affiliate;

        if (!$affiliate || $affiliate->available_balance <= 0) {
            return back()->with('error', 'Saldo tidak mencukupi untuk penarikan');
        }

        $request->validate([
            'amount' => ['required', 'numeric', 'min:50000', 'max:' . $affiliate->available_balance],
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string'
        ]);

        // Proses penarikan (implementasi sesuai kebutuhan)
        // ...

        return back()->with('success', 'Permintaan penarikan berhasil diajukan');
    }

    public function publicPage()
    {
        return view('affiliate.join');
    }
} 