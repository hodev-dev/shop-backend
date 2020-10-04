<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/auth_status', [AuthController::class, 'auth_status']);

Route::get('/logout', [AuthController::class, 'logout']);
