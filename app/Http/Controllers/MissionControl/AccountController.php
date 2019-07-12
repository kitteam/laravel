<?php

namespace App\Http\Controllers\MissionControl;

use App\Http\Controllers\Controller;

use Auth;
use Redirect;
use Illuminate\Http\Request;
use App\User;

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
    public function list()
    {
        $accounts = User::all();
        return view('mc.account', ['collections' => $accounts ?: [] ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth($id = false, Request $request)
    {
        $uri = route('mc.account.list');
        if ($id) {
            // Сохраняем идентификатор текущего администратора
            $request->session()->put('admin', Auth::user()->id);

            if (Auth::loginUsingId($id)) {
                $uri = route('cp.index');
            }
        }
        return Redirect::away($uri);
    }
}
