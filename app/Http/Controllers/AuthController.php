<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //
    public function getSignUp() {
        return view( 'auth.signup' );
    }

    public function getSignIn() {
        return view( 'auth.signin' );
    }

    public function postSignUp( Request $request ) {
        $this->validate( $request, User::$rules );
        User::create( [
            'email'    => $request->input( 'email' ),
            'username' => $request->input( 'username' ),
            'password' => bcrypt( $request->input( 'password' ) ),
        ] );

        return redirect()->route( 'home' )->with( 'info', 'Your account has been created and you can now sign in' );
    }

    public function postSignIn( Request $request ){
        $this->validate( $request, [
            'email'    => 'required',
            'password' => 'required'
        ] );

        if ( !Auth::attempt( $request->only( [ 'email', 'password' ] ), $request->has( 'remember' ) ) ) {
            return redirect()->back()->with( 'info', 'Could not sign you in with those details' );
        }
    }
}
