<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  //
  public function getProfile($username) {
    $user = User::where( 'username', $username )->first();
      if(!$user) {
        return redirect()->back()->with( 'info', 'User not exists' );
      }
    return view( 'profile.index', compact( 'user' ) );
  }

  public function getEdit() {
    return view( 'profile.edit' );
  }

  public function postEdit( ){

  }
}
