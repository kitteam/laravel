<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpTelegramBot\Laravel\PhpTelegramBotContract;
use Longman\TelegramBot\Request as TelegramBot;
use Cache;

class WebhookController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function handle(Request $request, PhpTelegramBotContract $telegram)
    {
        if (($key = $request->get('key')) && $key === env('PHP_TELEGRAM_WEBHOOK_KEY')) {
            if ($handle = $telegram->handle()) {

                $input = json_decode($telegram->getCustomInput(), true);
                if (isset($input['message'])) {
                    $message = $input['message'];
                    $chatId = $message['chat']['id'];
                    $text = $message['text'];

                    $foods = ['🥐','🥯','🍞','🥖','🥨','🧀','🥞','🥓','🥩','🍗','🍖',
                        '🦴','🌭','🍔','🍕','🥪','🥗','🍝','🍜','🍲','🍛','🍣','🥟',
                        '🍤','🍦','🥧','🧁','🍰','🎂','🍮','🍭','🍬','🍫','🍩','🍪','🌰'];

                    $counts = [];
                    foreach ($foods as $food) {
                        $counts[] = preg_match_all('/'. $food .'/', $text, $matches);
                    }

                    if ($counts = array_sum($counts)) {
                        $text = array_fill(0, $counts, 'мням');
                        $text = join(', ', $text);

                        $result = TelegramBot::sendMessage([
                            'chat_id' => $chatId,
                            'text'    => $text .'...',
                        ]);

                        $counts = Cache::pull('food') + $counts;
                        if ($counts > 10) {
                            $counts = 0;
                            $result = TelegramBot::sendMessage([
                                'chat_id' => $chatId,
                                'text'    => '💩',
                            ]);

                        }
                        Cache::forever('food', $counts);
                    }
                }
                return response()->json('received');
            }
        }
        return response()->json([ 'error' => 'Wrong authorized key' ], 403);
    }
}
