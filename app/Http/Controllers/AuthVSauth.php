<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthVSauth
{


    public function test()
    {
        // Auth
        if (Auth::check()) {
            echo "User is logged in <br>";
        }

        // Get the currently authenticated user
        $user = Auth::user();
        echo $user->name . "<br>";

        // Log in a user (using user model instance)
        Auth::login($user);

        // Log out the current user
        Auth::logout();



        // auth()

        // Check if a user is logged in
        if (auth()->check()) {
            echo "User is logged in <br>";
        }

        // Get the currently authenticated user
        $user = auth()->user();
        return $user->name . "<br>";

        // Log in a user (using user model instance)
        auth()->login($user);

        // Log out the current user
        auth()->logout();

        // Use a specific guard (e.g., 'admin' guard)
        $admin = auth('admin')->user();


        // Default 'web' guard
        $user = Auth::guard('web')->user();

        // Admin guard
        $admin = Auth::guard('admin')->user();


        // Default 'web' guard
        $user = auth('web')->user();

        // Admin guard
        $admin = auth('admin')->user();
    }
}
