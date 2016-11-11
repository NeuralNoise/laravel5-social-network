<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Status;
use App\Http\Controllers;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Display Home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show cabinet for authorized user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCabinet()
    {
        $statuses = Status::notReply()->where(function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('timeline.index', compact('statuses'));
    }
}
