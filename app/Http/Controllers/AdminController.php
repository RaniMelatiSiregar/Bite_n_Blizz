<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get counts for dashboard
        $productCount = Product::count();
        $userCount = User::where('role', 'user')->count();
        $orderCount = Order::count();
        $revenue = Order::sum('total_amount');

        return view('admin.layouts.index', compact('productCount', 'userCount', 'orderCount', 'revenue'))->with('title', 'Dashboard');
    }
} 