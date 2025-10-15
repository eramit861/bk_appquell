<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthHelper
{
    public static function attemptLogin($request)
    {
        $user = Auth::user();
        $user_find = User::whereId($user->id)->first();
        User::whereId($user->id)->update(['device_token' => $request->uuid_token, 'device_type' => 'Web', 'last_login_at' => now()]);
        if ($user_find->socket_token == null) {
            User::whereId($user->id)->update(['socket_token' => Str::random(32).time()]);
        }
        Session::put('socket_token', Auth::user()->socket_token);
    }
}
