<?php

namespace App\Http\Controllers;

use Auth;
use Status;
use Illuminate\Http\Request;
use App\Http\Requests;

class StatusController extends Controller
{
    //
    public function postStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:1000'
        ]);

        Auth::user()->statuses()->create(['body' => $request->input('status')]);

        return redirect()->route('home')->with('info', 'Status posted');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            'reply' => 'required|max:1000'
        ]);

        $status = Status::notReply()->find($statusId);

        if (!$status) {
            return redirect()->route('home');
        }
    }
}
