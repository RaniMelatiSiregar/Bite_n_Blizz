<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function adminIndex()
    {
        $orders = Order::with(['user'])
                      ->orderBy('created_at', 'desc')
                      ->get();
                      
        return view('admin.orders.index', [
            'title' => 'Data Transaksi',
            'orders' => $orders
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')
                        ->with('success', 'Status transaksi berhasil diperbarui');
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])
                     ->findOrFail($id);
                     
        return view('admin.orders.show', [
            'title' => 'Detail Transaksi',
            'order' => $order
        ]);
    }
} 