<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FriendController extends Controller
{
    //
    public function getIndex( ){
        $auth_user = Auth::user();
        $friends = $auth_user->friends();
        $friend_requests = $auth_user->friendRequests();

        return view( 'friends.index', compact('friends', 'friend_requests') );
    }

    public function getAdd( $username ){
        $user = User::where( 'username', $username )->first();

        if(!$user){
            return redirect()->back()->with('info', "User couldn't be find");
        }

        if ( Auth::user()->hasFriendRequestPending( $user ) ||
             $user->hasFriendRequestPending(Auth::user())) {
            return redirect()
                ->route( 'profile.index', [ 'username' => $user->username ] )
                ->with('info', 'Friend request already pending');
        }

    }
}
