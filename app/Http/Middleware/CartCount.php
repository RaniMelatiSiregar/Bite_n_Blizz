<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartCount
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            View::share('cartCount', $cartCount);
        }

        return $next($request);
    }
} 