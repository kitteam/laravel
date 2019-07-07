<?php

namespace App\Http\Controllers\MissionControl;

use Auth;
use Redirect;
use Tele2;
use App\User;
use Illuminate\Http\Request;

class TelephonyController extends Controller
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
    public function index(Tele2 $tele2)
    {
        $statuses = [
            'ANSWERED_COMMON' => 'отвечен в режиме вызова на конкретный номер (P2P)',
            'ANSWERED_BY_ORIGINAL_CLIENT' => 'отвечен оператором',
            'ANSWERED_BY_BUSY_FORWARD_CLIENT' => 'отвечен после переадресации по "Занято"' ,
            'ANSWERED_BY_NO_ANSWER_FORWARD_CLIENT' => 'отвечен после переадресации по "Нет ответа"',
            'NOT_ANSWERED_COMMON' => 'не отвечен',
            'CANCELLED_BY_CALLER' => 'отменен звонившим абонентом',
            'DENIED_DUE_TO_MAX_SESSION' => 'заблокирован по причине превышения макс. значения одновременных вызовов на клиенте',
            'DENIED_DUE_TO_INCOMING_CALLS_BLOCKED' => 'заблокирован по причине запрета входящих вызовов',
            'DENIED_DUE_TO_ONLY_INTERNAL_CALLS_ENABLED' => 'заблокирован по причине разрешения только внутренних вызовов',
            'DENIED_DUE_TO_BLACK_LISTED' => 'заблокирован по причине нахождения в черном списке',
            'DENIED_DUE_TO_NOT_WORK_TIME' => 'заблокирован по причине вызова в нерабочее время',
            'DENIED_DUE_TO_UNKNOWN_NUMBER' => 'заблокирован по причине неизвестного номера'
        ];

        $history = array_reverse($tele2::getHistory('-7 day'));
        $collections = json_decode(json_encode($history));
        return view('crm.index', ['collections' => $collections ?: [], 'statuses' => $statuses ]);
    }
}
