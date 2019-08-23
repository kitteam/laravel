<?php

namespace App\Http\Controllers\MissionControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shortlink;

class ShortlinkController extends Controller
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
        if ('GET' === $request->method()) {
            $data = $request->query();
            $data['shortlink'] = str_random(8);
            $shortlink->create($data);
        }
        //return view('mc.shortlink', ['collections' => $collections->all()]);
    }

    public function link($shortlink, Shortlink $instance)
    {
        $url = 'https://www.kit.team';
        if ($shortlink = $instance->where('shortlink', $shortlink)->first()) {
            $url = $shortlink->url;
        }
        return redirect($url);
    }
}
