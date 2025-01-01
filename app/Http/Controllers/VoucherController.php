<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function check($code)
    {
        $voucher = Voucher::where('code', $code)
                         ->where('is_active', true)
                         ->where('expiration_date', '>=', now())
                         ->first();

        if (!$voucher) {
            return response()->json([
                'valid' => false,
                'message' => 'Voucher tidak valid atau sudah kadaluarsa'
            ]);
        }

        return response()->json([
            'valid' => true,
            'voucher' => [
                'id' => $voucher->id,
                'discount' => $voucher->discount
            ],
            'message' => 'Voucher berhasil digunakan'
        ]);
    }

    // Admin Routes
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers',
            'discount' => 'required|numeric|min:1|max:100',
            'expiration_date' => 'required|date|after:today',
        ]);

        Voucher::create([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'expiration_date' => $request->expiration_date,
            'is_active' => true
        ]);

        return redirect()->route('vouchers.index')
                        ->with('success', 'Voucher berhasil dibuat');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code,' . $voucher->id,
            'discount' => 'required|numeric|min:1|max:100',
            'expiration_date' => 'required|date',
            'is_active' => 'boolean'
        ]);

        $voucher->update([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'expiration_date' => $request->expiration_date,
            'is_active' => $request->is_active ?? false
        ]);

        return redirect()->route('vouchers.index')
                        ->with('success', 'Voucher berhasil diperbarui');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('vouchers.index')
                        ->with('success', 'Voucher berhasil dihapus');
    }
}
