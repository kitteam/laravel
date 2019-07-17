<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserConfirmation;

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request as TelegramRequest;

class SendConfirmationNotification
{
    /**
     * Handle the event.
     *
     * @param  UserConfirmation  $event
     * @return void
     */
    public function handle(UserConfirmation $event)
    {
        $this->sendTelegram($event->user->email);
    }

    protected function sendTelegram($email)
    {
        $telegram = new Telegram(env('PHP_TELEGRAM_BOT_API_KEY'), env('PHP_TELEGRAM_BOT_NAME'));
        $telegramRequest = new TelegramRequest($telegram);

        $telegramRequest->sendMessage([
            'chat_id' => env('PHP_TELEGRAM_CHAT_ID'),
            'text'    => "Вав-вав. Подтверждение регистрации нового пользователя.\r\n{$email}"
        ]);
    }
}
