<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // Mengimpor model Transaksi
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    public function index()
    {        
        return view('admin.laporan.laporanPenjualan');
    }
}
