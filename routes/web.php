<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', function (Request  $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return response()->json([
            "isLogin" => Auth::check(),
            "role" => Auth::user()->role->with("permissions")->get(),
        ]);
    } else {
        return response()->json(["auth" => Auth::check()]);
    }
});

Route::get('/logout', function (Request  $request) {
    Auth::logout();
    return response()->json(["auth" => Auth::check()]);
});
