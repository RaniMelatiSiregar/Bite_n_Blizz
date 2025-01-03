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
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        
        // Jika status berubah menjadi processing, otomatis set payment_status menjadi paid
        if ($request->status === 'processing' && $order->status !== 'processing') {
            $order->update([
                'status' => $request->status,
                'payment_status' => 'paid',
                'paid_at' => now()
            ]);
        } else {
            $order->update(['status' => $request->status]);
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }
} 