<?php

namespace App\Http\Controllers\MissionControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shortlink;

use PhpTelegramBot\Laravel\PhpTelegramBotContract;
use Longman\TelegramBot\Request as TelegramBotRequest;

class ShortlinkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'add', 'edit', 'delete']);
        $this->middleware('web')->only('link');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shortlink $shortlink)
    {
        return view('mc.shortlink', ['collections' => $shortlink->all()]);
    }

    public function add(Request $request, Shortlink $shortlink)
    {
        if ('POST' === $request->method()) {
            $data = $request->post();
            $data['shortlink'] = str_random(8);
            $shortlink->create($data);
        }
        return view('mc.shortlink', ['collections' =>  $shortlink->all()]);
    }

    public function edit($id, Request $request, Shortlink $shortlink)
    {
        if ($shortlink = $shortlink->find($id)) {
            if ('POST' === $request->method()) {
                $data = $request->post();
                $shortlink->update($data);
                return view('mc.shortlink', ['collections' => $shortlink->all()]);
            }
            return view('mc.shortlink-modal', ['collection' => $shortlink]);
        }
    }

    public function delete($id, Request $request, Shortlink $shortlink)
    {
        if ($item = $shortlink->find($id)) {
            $item->delete();
        }
        return view('mc.shortlink', ['collections' =>  $shortlink->all()]);
    }

    public function link($shortlink, Shortlink $instance, PhpTelegramBotContract $telegram, Request $request)
    {
        $url = 'https://www.kit.team';
        if ($shortlink = $instance->where('shortlink', $shortlink)->first()) {
            $url = $shortlink->url;

            if ($referer = $request->server('HTTP_REFERER')) {
                TelegramBotRequest::sendMessage([
                    'chat_id' => env('PHP_TELEGRAM_CHAT_ID'),
                    'text'    => 'Гау-у-у. Переход по короткой ссылке c адреса '. $referer,
                ]);
            }
        }
        return redirect($url);
    }
}
