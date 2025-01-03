<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('admin.voucher.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.voucher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers',
            'discount' => 'required|numeric|min:1|max:100',
            'expires_at' => 'required|date|after:today',
        ]);

        Voucher::create([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'expires_at' => $request->expires_at,
            'is_active' => true
        ]);

        return redirect()->route('admin.voucher.index')
            ->with('success', 'Voucher berhasil dibuat');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.voucher.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code,' . $voucher->id,
            'discount' => 'required|numeric|min:1|max:100',
            'expires_at' => 'required|date',
            'is_active' => 'boolean'
        ]);

        $voucher->update([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'expires_at' => $request->expires_at,
            'is_active' => $request->is_active ?? false
        ]);

        return redirect()->route('admin.voucher.index')
            ->with('success', 'Voucher berhasil diperbarui');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.voucher.index')
            ->with('success', 'Voucher berhasil dihapus');
    }
} 