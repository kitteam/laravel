<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegistered;
use App\Mail\Auth\RegistrationEmail;
use Mail;

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request as TelegramRequest;

class SendRegisterNotification
{
    public function handle(UserRegistered $event)
    {
        Mail::to($event->user->email)->send(new RegistrationEmail($event->user, $event->password));

        $this->sendTelegram($event->user->email);
    }

    protected function sendTelegram($email)
    {
        $telegram = new Telegram(env('PHP_TELEGRAM_BOT_API_KEY'), env('PHP_TELEGRAM_BOT_NAME'));
        $telegramRequest = new TelegramRequest($telegram);

        $telegramRequest->sendMessage([
            'chat_id' => env('PHP_TELEGRAM_CHAT_ID'),
            'text'    => "Вав-вав. Предварительная регистрация нового пользователя.\r\n{$email}"
        ]);
    }
}
