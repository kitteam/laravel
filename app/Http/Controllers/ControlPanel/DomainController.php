<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Auth;

class DomainController extends Controller
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

    public function domain()
    {
        $domains = Auth::user()->domain;
        return view('cp.domain', ['collections' => $domains ?: [] ]);
    }
}
