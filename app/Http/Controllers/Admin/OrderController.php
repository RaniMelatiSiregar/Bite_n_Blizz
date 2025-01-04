<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])->latest()->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $orders = Order::with(['user', 'orderItems.product'])->find($id); // Menggunakan find() bukan findOrFail()
        if (!$orders) {
            return redirect()->route('admin.order.index')->with('error', 'Pesanan tidak ditemukan');
        }
        return view('admin.order.show', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $orders = Order::findOrFail($id);
        
        // Jika status berubah menjadi processing, otomatis set payment_status menjadi paid
        if ($request->status === 'processing' && $orders->status !== 'processing') {
            $orders->update([
                'status' => $request->status,
                'payment_status' => 'paid',
                'paid_at' => now()
            ]);
        } else {
            $orders->update(['status' => $request->status]);
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:paid,unpaid'
        ]);

        $orders = Order::findOrFail($id);
        
        if ($request->payment_status === 'paid' && $orders->payment_status !== 'paid') {
            $orders->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
                'status' => 'processing' // Otomatis ubah status menjadi processing
            ]);
            $message = 'Pembayaran telah dikonfirmasi';
        } else {
            $orders->update([
                'payment_status' => 'unpaid',
                'paid_at' => null
            ]);
            $message = 'Status pembayaran diubah menjadi belum dibayar';
        }

        return redirect()->back()->with('success', $message);
    }

    public function completeOrderFromAdmin($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != 'completed') {
            $order->update([
                'status' => 'completed',
            ]);
        }

        return redirect()->route('admin.order.index')->with('success', 'Pesanan telah selesai.');
    }

    public function destroy($id)
    {
        $orders = Order::findOrFail($id);
        $orders->delete();

        return redirect()->route('admin.order.index')->with('success', 'Pesanan berhasil dihapus');
    }
} 