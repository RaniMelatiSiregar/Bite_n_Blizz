<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
            'revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'userCount' => User::count(),
            'orders' => Order::with('user')
                           ->latest()
                           ->take(10)
                           ->get()
        ];

        return view('admin.dashboard', $data);
    }
} 