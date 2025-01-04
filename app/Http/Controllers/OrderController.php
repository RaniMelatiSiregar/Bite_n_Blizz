<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())
            ->with(['orderItems.product']);

        // Filter berdasarkan status
        if ($request->status) {
            switch ($request->status) {
                case 'pending':
                    $query->where('status', 'pending');
                    break;
                case 'processing':
                    $query->where('status', 'processing');
                    break;
                case 'completed':
                    $query->where('status', 'completed');
                    break;
                case 'cancelled':
                    $query->where('status', 'cancelled');
                    break;
            }
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        $currentStatus = $request->status;

        return view('public.orders.index', compact('orders', 'currentStatus'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['orderItems.product']);
        return view('public.orders.show', compact('order'));
    }

    public function completeOrder($id)
    {
        $orders = Order::findOrFail($id);

        if ($orders->status == 'processing') {
            $orders->update([
                'status' => 'completed',
            ]);
            
            return redirect()->route('orders.index')->with('success', 'Pesanan Anda telah selesai.');
        }

        return redirect()->route('orders.index')->with('error', 'Pesanan tidak dapat diselesaikan.');
    }

} 