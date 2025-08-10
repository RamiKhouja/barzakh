<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // public function handleGoogleCallback()
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->stateless()->user();

    //         $user = User::firstOrCreate(
    //             ['email' => $googleUser->getEmail()],
    //             [
    //                 'name' => $googleUser->getName(),
    //                 'email_verified_at' => now(),
    //                 'password' => bcrypt(Str::random(16)), // random password
    //             ]
    //         );

    //         Auth::login($user);

    //         return redirect()->route('home'); // or home
    //     } catch (\Exception $e) {
    //         return redirect('/login')->withErrors(['msg' => 'Unable to login using Google.']);
    //     }
    // }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if user already exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $fullName = $googleUser->getName(); 
            $name = explode(' ', $fullName, 2); 
            // Register the user
            $user = User::create([
                'firstname' => $name[0] ?? '',
                'lastname' => $name[1] ?? '',
                'email' => $googleUser->getEmail(),
                // Optional: store avatar or provider_id
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)), // Random password
                'role' => 'student', // Default role
            ]);
        }

        Auth::login($user);

        return redirect()->intended('/');
    }
}
