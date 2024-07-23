<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Resource routes for UserController
Route::resource('users', UserController::class);
