<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;

class FacebookAuthController extends Controller
{
    //
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){
        return Socialite::driver('facebook')->redirect();
    }
}
