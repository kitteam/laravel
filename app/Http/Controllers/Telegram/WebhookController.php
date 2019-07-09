<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpTelegramBot\Laravel\PhpTelegramBotContract;

class WebhookController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function handle(Request $request, PhpTelegramBotContract $telegram)
    {
        if (($key = $request->get('key')) && $key === env('PHP_TELEGRAM_WEBHOOK_KEY')) {
            $telegram->handle();
        }
        return response()->json([ 'error' => 'Wrong authorized key' ], 403);
    }
}
