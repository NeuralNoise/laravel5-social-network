<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Http\Requests;

class HomeController extends Controller
{
    //
    public function index( ){
        if ( Auth::check() ) {
            return view( 'timeline.index' );
        }
        return view( 'home' );
    }
}
