<?php

namespace App\Http\Controllers;

use Auth;
use App\UserDomain;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        return view('user');
    }

    public function domain()
    {
        $domains = Auth::user()->domain;
        return view('user.domain', ['collections' => $domains ?: [] ]);
    }

    public function hosting()
    {
        $hostings = Auth::user()->hosting;
        return view('user.hosting', ['collections' => $hostings ?: [] ]);
    }
}
