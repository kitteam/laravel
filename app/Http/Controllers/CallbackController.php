<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use PhpTelegramBot\Laravel\PhpTelegramBotContract;
use Longman\TelegramBot\Request as TelegramBotRequest;

use Request;
use Tele2;
use Cache;

class CallbackController extends Controller
{
    public function tele2(Request $request, Tele2 $tele2, PhpTelegramBotContract $telegram)
    {
        if (($key = $request::get('key')) && $key == env('TELE2_CALLBACK_KEY')) {
            $calls = [];
            if ($currents = $tele2::getCurrent()) {
                $calls = array_column($currents, 'callerNumberFull');
                if ($call = array_diff($calls, (Cache::pull('calls') ?: []) )) {
                    TelegramBotRequest::sendMessage([
                        'chat_id' => env('PHP_TELEGRAM_CHAT_ID'),
                        'text'    => 'Гау-у-у. Вам звонит номер '. current($call),
                    ]);
                }
            }
            Cache::forever('calls', $calls);
            return response()->json($currents);
        }
        return response()->json([ 'error' => 'Wrong authorized key' ], 403);
    }
}
