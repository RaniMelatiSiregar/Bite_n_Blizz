<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StoreSettingController;


// Login & Register Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Admin Routes (protected)
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Logout Route
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
    
    // Kategori Routes
    Route::resource('categories', CategoryController::class);
    Route::get('/dashboard/checkSlug', [CategoryController::class, 'checkSlug']);
    
    // Produk Routes
    Route::resource('produk', ProdukController::class);
    Route::get('/produks/checkSlug', [ProdukController::class, 'checkSlug']);
    
    // Customer Routes
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    
    // Order Management
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
});

// User Routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('public.home');
    })->name('home');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Product Routes
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/details', function () {
        return view('public.product.detail');
    })->name('product.details');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/check-voucher/{code}', [VoucherController::class, 'check'])->name('voucher.check');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::put('/orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');

    // Other Routes
    Route::get('/favorite', function () {
        return view('public.favorite');
    })->name('favorite');

    Route::get('/about', function () {
        return view('public.AboutUs.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('public.contact');
    })->name('contact');
});

// Voucher Routes
Route::resource('vouchers', VoucherController::class);

//Setting Routes
Route::resource('store-settings', StoreSettingController::class);
