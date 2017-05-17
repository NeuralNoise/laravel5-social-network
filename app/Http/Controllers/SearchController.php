<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Get search key and return results
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory |\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getResults(Request $request)
    {

        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('home');
        }

        $users = User::where(DB::raw("first_name + ' ' + last_name"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "{$query}%")
            ->get();
        return view('search.results', compact('users'));
    }
}
