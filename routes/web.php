<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('public.home');
});
Route::get('/product', function () {
    return view('public.product.product');
});
Route::get('/product/details', function () {
    return view('public.product.detail');
});
Route::get('/chart', function () {
    return view('public.chart');
})->name('chart');
Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});

Route::get('/favorite', function () {
    return view('public.favorite');
})->name('favorite');

Route::get('/about', function () {
    return view('public.AboutUs.about');
});
Route::get('/contact', function () {
    return view('public.contact');
});

Route::get('/profile', function () {
    return view('public.profile.index');
})->name('profile');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


