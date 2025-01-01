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

// Login Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//dashboard Admin
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::resource('categories', CategoryController::class);
Route::get('/dashboard/checkSlug', [CategoryController::class, 'checkSlug']);

Route::resource('produk', ProdukController::class);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
       
    });

    // User Routes
    Route::get('/home', function () {
        return view('public.home');
    })->name('home');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/product/details', function () {
        return view('public.product.detail');
    })->name('product.details');

    Route::get('/favorite', function () {
        return view('public.favorite');
    })->name('favorite');

    Route::get('/about', function () {
        return view('public.AboutUs.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('public.contact');
    })->name('contact');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::put('/orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');
});

Route::resource('vouchers', VoucherController::class);

