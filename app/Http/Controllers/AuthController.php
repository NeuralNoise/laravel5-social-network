<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    /**
     * Show Sign Up page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSignUp()
    {
        return view('auth.signup');
    }

    /**
     * Show Sign In page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSignIn()
    {
        return view('auth.signin');
    }

    /**
     * Save registration data
     *
     * @param Request $request
     * @return mixed
     */
    public function postSignUp(Request $request)
    {

        $this->validate($request, User::$rules);

        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->intended('cabinet')->with('info', 'You are now signed in');
    }

    /**
     * Authorize a user
     *
     * @param Request $request
     * @return mixed
     */
    public function postSignIn(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->intended('cabinet')->with('info', 'You are now signed in');
        }

        return redirect()->back()->withErrors('Could not sign you in with those details');
    }

    /**
     * Log out a user and redirect on home page
     *
     * @return mixed
     */
    public function getSignOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
