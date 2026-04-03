<?php

use Illuminate\Support\Facades\Route;

// Protected Client Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('client.order');
    })->name('dashboard');

    Route::get('/account/profile', function () {
        return view('client.profile');
    })->name('profile');
});
