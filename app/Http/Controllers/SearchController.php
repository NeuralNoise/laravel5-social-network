<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Http\Requests;

class SearchController extends Controller
{
  //
  public function getResults( ){
    return view( 'search.results' );
  }
}
