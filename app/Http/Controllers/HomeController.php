<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Status;
use App\Http\Controllers;
use App\Http\Requests;

class HomeController extends Controller
{
    //
    public function index( ){
        if ( Auth::check() ) {
            $statuses = Status::where(function($query){
                $query->where('user_id', Auth::user()->id)
                      ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
            })->orderBy('created_at', 'desc')->paginate(10);
            return view( 'timeline.index', compact('statuses') );
        }
        return view( 'home' );
    }
}
