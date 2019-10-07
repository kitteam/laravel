<?php

namespace App\Listeners\Callback;

use App\Events\Callback\IncomingCall;

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request as TelegramRequest;

class SendIncomingСallNotification
{
    /**
     * Handle the event.
     *
     * @param  IncomingCall  $event
     * @return void
     */
    public function handle(IncomingCall $event)
    {
        foreach ($event->calls as $call) {
            $phoneNumber = phone($call['callerNumberFull'], 'RU', 'international');
            $this->sendTelegram($phoneNumber);
        }
    }

    protected function sendTelegram($phoneNumber)
    {
        $telegram = new Telegram(env('PHP_TELEGRAM_BOT_API_KEY'), env('PHP_TELEGRAM_BOT_NAME'));
        $telegramRequest = new TelegramRequest($telegram);

        $telegramRequest->sendMessage([
            'chat_id' => env('PHP_TELEGRAM_CHAT_ID'), // 151840872
            'text'    => "Гау-у-у. Вам звонит номер\r\n{$phoneNumber}"
        ]);
    }
}
