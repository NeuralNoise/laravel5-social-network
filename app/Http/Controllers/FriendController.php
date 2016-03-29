<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FriendController extends Controller
{
    //
    public function getIndex( ){
        return view( 'friends.index' );
    }
}
