<?php

use App\Models\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/auth_status', [AuthController::class, 'auth_status']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/collections', function () {
  return Collection::with("games.prices.currency")->get();
});
