<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // Ubah model ke Transaction
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        // Validasi parameter status jika ada
        $validStatuses = ['Perlu Diproses', 'Telah Diproses', 'Tertunda'];
        $query = Transaction::query(); // Pastikan model menggunakan Transaction

        // Filter berdasarkan status jika ada
        if ($request->has('status') && in_array($request->status, $validStatuses)) {
            $query->where('status', $request->status);
        }

        // Paginate untuk hasil lebih efisien
        $transactions = $query->paginate(10);

        // Hitung berdasarkan status
        $countPerluDiproses = Transaction::where('status', 'Perlu Diproses')->count();
        $countTelahDiproses = Transaction::where('status', 'Telah Diproses')->count();
        $countTertunda = Transaction::where('status', 'Tertunda')->count();

        $title = 'Data Transaksi';

        // Mengembalikan data ke view dengan kompiling variabel
        return view('admin.transaksi.data', compact(
            'transactions', 
            'countPerluDiproses', 
            'countTelahDiproses', 
            'countTertunda',
            'title'
        ));
    }
}
