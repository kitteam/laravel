<?php

namespace App\Http\Controllers;

use Auth;
use App\UserDomain;
use App\UserHosting;
use Illuminate\Http\Request;
use Redirect;
use Vesta;

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
    public function index()
    {
        return view('user.index');
    }

    public function domain()
    {
        $domains = Auth::user()->domain;
        return view('user.domain', ['collections' => $domains ?: [] ]);
    }

    public function hosting($id = false)
    {
        stream_context_set_default(array(
            'ssl'                => array(
            'peer_name'          => 'generic-server',
            'verify_peer'        => FALSE,
            'verify_peer_name'   => FALSE,
            'allow_self_signed'  => TRUE
        )));

        if ($id) {
            if ($userHosting = UserHosting::where('user_id', Auth::user()->id)->find($id)) {
                $url = 'https://'. $userHosting->server .'/artisan/';
                if ('vh1.kit.team' == $userHosting->server) {
                    $url = 'https://'. $userHosting->server .':8083/artisan/';
                }

                $vesta = Vesta::server($userHosting->server)->setUserName($userHosting->account);
                if (($data = $vesta->listUserAccount()) && ($rkey = $data[$userHosting->account]['RKEY'])) {
                    $redirect = $url .'?user='. $userHosting->account .'&token='. hash('sha256', $rkey);
                    return Redirect::away($redirect);
                }
            }
        }
        $hostings = Auth::user()->hosting;
        return view('user.hosting', ['collections' => $hostings ?: [] ]);
    }
}
