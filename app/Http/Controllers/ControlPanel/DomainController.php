<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Auth;
use App\UserDomain;

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

    public function list()
    {
        $domains = Auth::user()->domain;
        return view('cp.domain', ['collections' => $domains ?: [] ]);
    }

    public function info($id = false)
    {
        if ($id) {
            if ($userDomain = UserDomain::where('user_id', Auth::user()->id)->find($id)) {
                return view('cp.domain.info', ['collection' => $userDomain ?: [] ]);
            }
        }

        return $this->list();
    }
}
