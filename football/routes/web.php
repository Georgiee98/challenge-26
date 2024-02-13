<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'is_admin'])->group(function () {
    // Protected routes for admin
});

Route::get('/', function () {
    return view('welcome');
});