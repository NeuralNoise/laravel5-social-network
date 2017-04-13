<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FriendController extends Controller
{
    /**
     * Display a list of friends
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $auth_user = Auth::user();
        $friends = $auth_user->friends();
        $friend_requests = $auth_user->friendRequests();

        return view('friends.index', compact('friends', 'friend_requests'));
    }

    /**
     * Add friend
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();
        $auth_user = Auth::user();
        $redirect_profile = redirect()
            ->route('profile.index', ['username' => $user->username]);

        if (!$user) {
            return redirect()->back()->with('info', "User couldn't be find");
        }

        if (Auth::user()->id === $user->id) {
            return redirect()->route('home');
        }

        if ($auth_user->hasFriendRequestPending($user) ||
            $user->hasFriendRequestPending($auth_user)
        ) {
            return $redirect_profile->with('info', 'Friend request already pending');
        }

        if ($auth_user->isFriendsWith($user)) {
            return $redirect_profile->with('info', 'You are already friends');
        }

        $auth_user->addFriend($user);

        return $redirect_profile->with('info', 'Friend request sent');

    }

    /**
     * Accept request to be a friend for specific user
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('info', "User couldn't be find");
        }

        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('profile.index', ['username' => $username])
            ->with('info', 'Friend request accepted.');
    }
}
