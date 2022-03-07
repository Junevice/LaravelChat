<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginGoogleUser($user);

        //return home after login
        return redirect()->route('dashboard');
    }

    protected function _registerOrLoginGoogleUser($incomingUser){
        $user = User::where('google_id', $incomingUser->id)->first();
        if(!$user){
            $user = new User();
            $user->name = $incomingUser->name;
            $user->email = $incomingUser->email;
            $user->google_id = $incomingUser->id;
            $user->password = encrypt('password'); //make password nullable
            $user->save();
        }
        Auth::login($user);
    }
}
