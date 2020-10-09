<?php

use App\Models\Game;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Price;
use Illuminate\Support\Facades\Response;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return User::all();
    });
    Route::get('/currency', function (Request $request) {
        return Currency::all();
    });
    Route::get('/games', function (Request $request) {
        return Game::with('prices')->with('prices.currency')->orderBy('created_at', 'desc')->take(25)->get();
    });

    Route::post('/steam', function (Request $request) {
        $response = Http::get("https://store.steampowered.com/api/appdetails", [
            'appids' => $request->steamID,
        ]);
        $game = $response->json()[$request->steamID];
        if ($game['success'] === true) {
            $new_game = Game::where('steam_id', $request->steamID)->firstOrCreate(
                [
                    'name' => $game['data']['name'],
                    'steam_id' => $game['data']['steam_appid'],
                    'header_url' => $game['data']['header_image'],
                ]
            );
            return $new_game;
        } else {
            return Response::json([], 404);
        }
    });

    Route::post('/price', function (Request $request) {
        if (!is_null($request->region) && !is_null($request->steamID)) {
            $game = Game::where('steam_id', $request->steamID)->first();
            if (!is_null($game)) {
                $currency = Currency::where('name', $request->region)->first();
                $steam_response = Http::get("https://store.steampowered.com/api/appdetails", [
                    'appids' => $request->steamID,
                    'cc' => $request->region,
                    'filters' => "price_overview"
                ]);
                $game_data = $steam_response->json()[$request->steamID];
                if ($game_data['success'] === true) {
                    Price::where('game_id', $game->id)->updateOrCreate([
                        'game_id' => $game->id,
                        'currency_id' => $currency->id,
                        'price' => $game_data['data']['price_overview']['initial'],
                        'discount_percent' => $game_data['data']['price_overview']['discount_percent'],
                        'final_price' => $game_data['data']['price_overview']['final'],
                    ]);
                    return Response::json([
                        'steam_id' => $request->steamID,
                        'game_id' => $game->id,
                        'currency_id' => $currency->id,
                        'price' => $game_data['data']['price_overview']['initial'],
                        'discount_percent' => $game_data['data']['price_overview']['discount_percent'],
                        'final_price' => $game_data['data']['price_overview']['final'],
                    ]);
                } else {
                    return Response::json([
                        $request->region,
                        $request->steamID,
                    ]);
                }
            } else {
                return Response::json([], 404);
            }
        } else {
            return Response::json([], 404);
        }
    });
});
