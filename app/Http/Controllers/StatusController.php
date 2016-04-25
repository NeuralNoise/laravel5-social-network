<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Status;
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
        $this->validate($request,[
            "reply-{$statusId}" => 'required|max:1000',
        ]);

        $auth_user = Auth::user();
        $redirect_home = redirect()->route('home');
        $status = Status::notReply()->find($statusId);

        if (!$status) {
            return $redirect_home;
        }

        if (!$auth_user->isFriendsWith($status->user) && $auth_user->id !== $status->user->id) {
            return $redirect_home;
        }

        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}")
        ])->user()->associate($auth_user);

        $status->replies()->save($reply);

        return redirect()->back();
    }

    public function getLike($likeId){
        dd($likeId);
    }
}
