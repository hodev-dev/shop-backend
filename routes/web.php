<?php

use App\Models\Game;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/auth_status', [AuthController::class, 'auth_status']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/collections', function () {
  return Collection::with("games.prices.currency")->get();
});

Route::get('/games_paginate', function () {
  return Game::with("prices.currency")->paginate();
});
Route::post('/game_info', function (Request $request) {
  return Game::where('steam_id', $request->steamID)->with("prices.currency")->firstOrFail();
});
