<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalCustomers' => User::where('is_admin', false)->count(),
            'totalVouchers' => Voucher::count(),
            'lowStockProducts' => Product::where('qty', '<=', 10)->get(),
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
            'recentCustomers' => User::where('is_admin', false)->latest()->take(5)->get(),
            'activeVouchers' => Voucher::where('expires_at', '>', now())->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
} 