<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/members', function () {
    return view('admin.members');
})->name('members');

// Các route admin khác sẽ được thêm tại đây
