<?php

namespace App\Http\Controllers;

use Auth;
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

    $statuses = $user->statuses()->notReply()->get();

    return view( 'profile.index', compact( ['user','statuses'] ) )
        ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
  }

  public function getEdit() {
    return view( 'profile.edit' );
  }

  public function postEdit(Request $request){
    $this->validate( $request, [
        'first_name' => 'alpha_num|max:255',
        'last_name'  => 'alpha_num|max:255',
        'location'   => 'max:20',
    ] );

    Auth::user()->update( $request->except('_token') );

    return view( 'profile.edit' )->with( 'info', 'Your profile was updated' );
  }
}
