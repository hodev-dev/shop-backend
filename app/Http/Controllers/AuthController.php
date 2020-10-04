<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $request_data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if (Auth::attempt($request_data)) {
            return response()->json([
                "isLoggedIn" => Auth::check(),
                "user" => Auth::user(),
                "role" => Auth::user()->role->with("permissions")->get(),
            ]);
        } else {
            return response()->json([
                "isLoggedIn" => Auth::check(),
                "user" => [],
                "role" => [],
            ]);
        }
    }

    public function auth_status()
    {
        if (Auth::check()) {
            return response()->json([
                "isLoggedIn" => Auth::check(),
                "user" => Auth::user(),
                "role" => Auth::user()->role->with("permissions")->get(),
            ]);
        } else {
            return response()->json([
                "isLoggedIn" => Auth::check(),
                "user" => [],
                "role" => [],
            ]);
        }
    }

    public function logout(Request  $request)
    {
        Auth::logout();
        return response()->json([
            "isLoggedIn" => Auth::check(),
            "user" => [],
            "role" => [],
        ]);
    }
}
