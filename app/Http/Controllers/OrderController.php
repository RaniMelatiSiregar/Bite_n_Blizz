<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id());
        
        // Filter berdasarkan status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();
        
        // Hitung jumlah pesanan yang perlu dikirim
        $pendingCount = Order::where('user_id', Auth::id())
                            ->where('status', 'pending')
                            ->count();
        
        return view('public.orders.index', compact('orders', 'pendingCount'));
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        
        if ($order->status != 'pending') {
            return redirect()->back()->with('error', 'Hanya pesanan dengan status Perlu Dikirim yang dapat dibatalkan');
        }
        
        $order->update(['status' => 'cancelled']);
        
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function complete($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        
        if ($order->status != 'processing') {
            return redirect()->back()->with('error', 'Hanya pesanan dengan status Sedang Dikirim yang dapat diselesaikan');
        }
        
        $order->update(['status' => 'completed']);
        
        return redirect()->back()->with('success', 'Pesanan telah selesai');
    }
} 