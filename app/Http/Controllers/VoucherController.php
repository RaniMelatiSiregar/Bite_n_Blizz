<?php

namespace App\Http\Controllers;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
        // Display a listing of the vouchers
        public function index()
        {
            $vouchers = Voucher::all();
            $title = 'Voucher List';
            return view('admin.promo.index', compact('vouchers'));
        }
    
        // Show the form for creating a new voucher
        public function create()
        {
            return view('admin.promo.create');
        }
    
        // Store a newly created voucher in storage
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'code' => 'required|unique:vouchers',
                'discount' => 'required|numeric|min:0',
                'expiration_date' => 'required|date',
            ]);
    
            Voucher::create($validatedData);
            return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully');
        }
    
        // Display the specified voucher
        public function show($id)
        {
            $voucher = Voucher::find($id);
            if (!$voucher) {
                return redirect()->route('vouchers.index')->with('error', 'Voucher not found');
            }
            return view('vouchers.show', compact('voucher'));
        }
    
        // Show the form for editing the specified voucher
        public function edit($id)
        {
            $voucher = Voucher::find($id);
            if (!$voucher) {
                return redirect()->route('vouchers.index')->with('error', 'Voucher not found');
            }
            return view('admin.promo.edit', compact('voucher'));
        }
    
        // Update the specified voucher in storage
        public function update(Request $request, $id)
        {
            $voucher = Voucher::find($id);
            if (!$voucher) {
                return redirect()->route('vouchers.index')->with('error', 'Voucher not found');
            }
    
            $validatedData = $request->validate([
                'code' => 'required|unique:vouchers,code,' . $id,
                'discount' => 'required|numeric|min:0',
                'expiration_date' => 'required|date',
                'is_active' => 'boolean',
            ]);
    
            $voucher->update($validatedData);
            return redirect()->route('vouchers.index')->with('success', 'Voucher updated successfully');
        }
    
        // Remove the specified voucher from storage
        public function destroy($id)
        {
            $voucher = Voucher::find($id);
            if (!$voucher) {
                return redirect()->route('vouchers.index')->with('error', 'Voucher not found');
            }
    
            $voucher->delete();
            return redirect()->route('vouchers.index')->with('success', 'Voucher deleted successfully');
        }
}
