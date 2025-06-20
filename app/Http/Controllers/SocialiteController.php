<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{

    public function login(){
        return Socialite::driver('google')->redirect();
    }

    public function redirect(){
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::updateOrCreate(
            ['email'=>$googleUser->getEmail()]
            ,[
            'google_id'=> $googleUser->getId(),
            'name'=> $googleUser->getName(),
            'email'=> $googleUser->getEmail(),
        ]);
        // Auth User 
        Auth::login($user,true);
        // Redirect to blog
        return to_route('theme.index');
        // dd($googleUser);
    }

}
