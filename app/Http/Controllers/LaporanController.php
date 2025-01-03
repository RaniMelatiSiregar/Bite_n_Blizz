<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Order::with('customer');

            // Filter berdasarkan tanggal
            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [
                    Carbon::parse($request->start_date)->startOfDay(),
                    Carbon::parse($request->end_date)->endOfDay()
                ]);
            }

            // Filter berdasarkan status
            if ($request->status) {
                $query->where('status', $request->status);
            }

            // Ambil data transaksi
            $transaksi = $query->latest()->get();

            // Hitung total
            $total_transaksi = $transaksi->count();
            $total_pendapatan = $transaksi->where('status', 'success')->sum('total');
            $total_produk = OrderItem::whereIn('order_id', $transaksi->pluck('id'))->sum('quantity');
            $total_customer = User::count();

            return view('admin.laporan.index', compact(
                'transaksi',
                'total_transaksi',
                'total_pendapatan',
                'total_produk',
                'total_customer'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        try {
            $query = Order::with('customer');

            // Filter berdasarkan tanggal
            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [
                    Carbon::parse($request->start_date)->startOfDay(),
                    Carbon::parse($request->end_date)->endOfDay()
                ]);
            }

            // Filter berdasarkan status
            if ($request->status) {
                $query->where('status', $request->status);
            }

            $transaksi = $query->latest()->get();

            // Nama file
            $filename = 'laporan-penjualan-' . Carbon::now()->format('Y-m-d') . '.csv';

            // Header Excel
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            // Data untuk CSV
            $callback = function() use ($transaksi) {
                $file = fopen('php://output', 'w');
                
                // Header CSV
                fputcsv($file, [
                    'No. Invoice',
                    'Tanggal',
                    'Customer',
                    'Total',
                    'Status'
                ]);

                // Data rows
                foreach ($transaksi as $item) {
                    fputcsv($file, [
                        $item->invoice_number,
                        $item->created_at->format('d M Y H:i'),
                        $item->customer->name ?? 'Customer tidak ditemukan',
                        number_format($item->total, 0, ',', '.'),
                        $item->status
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengexport data: ' . $e->getMessage());
        }
    }
} 