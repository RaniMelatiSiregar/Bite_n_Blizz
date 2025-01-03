<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AffiliateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    $products = \App\Models\Product::with('category')->get();
    $categories = \App\Models\Category::all();
    return view('public.home', compact('products', 'categories'));
})->name('home');

// About Route
Route::get('/about', function () {
    return view('public.about.index');
})->name('about');

// Contact Route
Route::get('/contact', function () {
    return view('public.contact.index');
})->name('contact');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('product.index');

// Cart Routes
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Affiliate Routes
Route::get('/affiliate/public', [AffiliateController::class, 'publicPage'])->name('affiliate.public');
Route::middleware('auth')->group(function () {
    Route::get('/affiliate', [AffiliateController::class, 'index'])->name('affiliate.dashboard');
    Route::post('/affiliate/join', [AffiliateController::class, 'join'])->name('affiliate.join');
    Route::post('/affiliate/withdraw', [AffiliateController::class, 'withdraw'])->name('affiliate.withdraw');
});

// Admin Routes
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('logout');
    
    // Products
    Route::resource('product', AdminProductController::class);
    
    // Categories  
    Route::resource('category', CategoryController::class);
    
    // Orders
    Route::resource('order', AdminOrderController::class);
    Route::put('/order/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('order.status');
    
    // Vouchers
    Route::resource('voucher', VoucherController::class);

    // Affiliate Management
    Route::get('/affiliates', [App\Http\Controllers\Admin\AffiliateController::class, 'index'])->name('affiliate.index');
    Route::get('/affiliates/{affiliate}', [App\Http\Controllers\Admin\AffiliateController::class, 'show'])->name('affiliate.show');
    Route::put('/affiliates/{affiliate}/commission', [App\Http\Controllers\Admin\AffiliateController::class, 'updateCommission'])->name('affiliate.commission');
    Route::put('/affiliates/{affiliate}/toggle', [App\Http\Controllers\Admin\AffiliateController::class, 'toggleStatus'])->name('affiliate.toggle');
    Route::get('/affiliate-withdrawals', [App\Http\Controllers\Admin\AffiliateController::class, 'withdrawals'])->name('affiliate.withdrawals');
    Route::post('/affiliate-withdrawals/{withdrawal}/approve', [App\Http\Controllers\Admin\AffiliateController::class, 'approveWithdrawal'])->name('affiliate.withdrawal.approve');
    Route::post('/affiliate-withdrawals/{withdrawal}/reject', [App\Http\Controllers\Admin\AffiliateController::class, 'rejectWithdrawal'])->name('affiliate.withdrawal.reject');
});
