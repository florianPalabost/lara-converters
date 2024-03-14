<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();

        if (! $user) {
            $user = User::create([
                'name'     => $googleUser->name,
                'email'    => $googleUser->email,
                'password' => Hash::make(rand(100_000, 999_999)),
            ]);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
