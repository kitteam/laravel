<?php

namespace App\Http\Controllers\Vk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpTelegramBot\Laravel\PhpTelegramBotContract;
use Longman\TelegramBot\Request as TelegramBotRequest;
use Log;

class WebhookController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function handle(Request $request, PhpTelegramBotContract $telegram)
    {
        if (($key = $request->get('secret')) && $key === env('VKONTAKTE_CALLBACK_KEY')) {
            if (($type = $request->get('type'))) {
                $method = preg_replace('/([a-z])_([a-z])/', '$1$2', $type);
                Log::info($method);
                if (!method_exists($this, $method)) {
                    $method = 'undefined';
                }
                $message = [
                    'chat_id' => env('PHP_TELEGRAM_CHAT_ID'),
                    'text' => call_user_func_array(array($this, $method), [$request])
                ];
                //$message['chat_id'] = 151840872;
                TelegramBotRequest::sendMessage($message);
                return response('ok');
            }
            return response()->json([ 'error' => 'The request type is not defined' ]);
        }
        return response()->json([ 'error' => 'Wrong authorized key' ], 403);
    }

    /**
     * Удаление участника из сообщества
     */
    protected function groupLeave(Request $request)
    {
        $collect = collect($request->get('object'));
        $userId = $collect->get('user_id');
        $self = $collect->get('self');

        $options = [
            'Гав. Администратор удалил участника',
            'Гав печаль. Участник покинул сообщество'
        ];

        $message = [
            $options[$self],
            'https://vk.com/id'. $userId
        ];

        return join("\r\n\r\n", $message);
    }

    /**
     * Добавление участника или заявки на вступление в сообщество
     */
    protected function groupJoin(Request $request)
    {
        $collect = collect($request->get('object'));
        $userId = $collect->get('user_id');
        $type = $collect->get('join_type');

        $options = [
            'join' => 'Пользователь вступил в группу или мероприятие (подписался на публичную страницу)',
            'unsure' => 'Пользователь выбрал вариант «Возможно, пойду»',
            'accepted' => 'Пользователь принял приглашение в группу или на мероприятие',
            'approved' => 'Заявка на вступление в группу/мероприятие была одобрена руководителем сообщества',
            'request' => 'Пользователь подал заявку на вступление в сообщество'
        ];

        $message = [
            'ГА-А-АВ. '. $options[$type],
            'https://vk.com/id'. $userId
        ];

        return join("\r\n\r\n", $message);
    }

    protected function undefined(Request $request)
    {
        $result = [
            'Гав. Событие в VK. Шайтанама, что с этими данными делать.',
            "\r\n\r\n",
            (string) $request
        ];
        return join($result);
    }
}

/*
protected function confirmation(Request $request)
{
    if (($group = $request->get('group_id')) && $group == env('VKONTAKTE_GROUP_ID')) {
        return [env('VKONTAKTE_CALLBACK_CONFIRMATION');
    }
}
