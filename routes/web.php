<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/about', function () {
    return view('public.AboutUs.about');
});


