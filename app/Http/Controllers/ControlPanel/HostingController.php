<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Vesta;

class MainController extends Controller
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
        return view('cp.hosting.list', ['collections' => $hostings ?: [] ]);
    }
}
