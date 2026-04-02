<?php

use Illuminate\Support\Facades\Route;

// Protected Client Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('client.dashboard');
    })->name('dashboard');
});
