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
        $user = User::where('email', $incomingUser->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $incomingUser->name;
            $user->email = $incomingUser->email;
            $user->google_id = $incomingUser->id;
            $user->password = encrypt('password_google'); //make password nullable
            $user->avatar = "#FFFFFF";
            $user->save();
        }
        
        if($user->google_id==null){
            $user->google_id=$incomingUser->id;
            $user->save();
        }

        Auth::guard('web')->login($user);
    }

    public function loginwithTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
       
    public function cbTwitter()
    {
        try {
     
            $user = Socialite::driver('twitter')->user();
      
            $userWhere = User::where('email', $user->email)->first();
      
            if($userWhere){

                if($userWhere->twitter_id==null){
                    $userWhere->twitter_id=$user->id;
                    $userWhere->save();
                }

                Auth::guard('web')->login($userWhere);
                return redirect('/dashboard');
      
            }else{

                $getUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'twitter_id'=> $user->id,
                    'password' => encrypt('password_twitter'),
                    'avatar' => '#FFFFFF'
                ]);
     
                Auth::guard('web')->login($getUser);
                return redirect('/dashboard');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function getinfos(){
        $user = Auth::guard('web')->user();
        return $user;
    }


    public function logout(Request $request){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
