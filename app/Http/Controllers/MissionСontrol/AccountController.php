<?php

namespace App\Http\Controllers\MissionControl;

use Auth;
use Redirect;
use Tele2;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        $accounts = User::all();
        return view('mcc.account', ['collections' => $accounts ?: [] ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth($id = false)
    {
        $uri = route('mcc.account');
        if ($id) {
            if (Auth::loginUsingId($id)) {
                $uri = route('cp.index');
            }
        }
        return Redirect::away($uri);
    }
}
