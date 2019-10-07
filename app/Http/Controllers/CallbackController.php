<?php

namespace App\Http\Controllers;

use App\Events\Callback\IncomingCall;

use Request;
use Tele2;
use Cache;
use Log;

class CallbackController extends Controller
{
    public function tele2(Request $request, Tele2 $tele2)
    {
        if (($key = $request::get('key')) && $key == env('TELE2_CALLBACK_KEY')) {
            //$calls = [];
            $prev = (array) Cache::pull('call');
            $current = (array) $tele2::getCurrent();

            if ($prev !== $current) {
                if ($calls = array_diff_key($current, $prev)) {
                    event(new IncomingCall($calls));
                } elseif ($calls = array_diff_key($prev, $current)) {
                    Log::info('Завершение звонка');
                    Log::info($calls);
                } else {
                    Log::info('Изменение статуса');
                    Log::info($current);
                }
                //$calls = array_column($currents, 'callerNumberFull');
                //if ($call = array_diff($calls, (Cache::pull('calls') ?: []) )) {
                //    TelegramBotRequest::sendMessage([
                //        'chat_id' => env('PHP_TELEGRAM_CHAT_ID'),
                //        'text'    => 'Гау-у-у. Вам звонит номер '. current($call),
                //    ]);
                //}
            }

            Cache::forever('call', $current);
            return response()->json($current);
        }
        return response()->json([ 'error' => 'Wrong authorized key' ], 403);
    }
}
