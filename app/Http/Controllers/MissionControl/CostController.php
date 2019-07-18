<?php

namespace App\Http\Controllers\MissionControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tld;

class CostController extends Controller
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

    public function tld(Request $request)
    {
        $group = $request->get('group') ?? 'cis';
        $collections = Tld::where('group', $group)->get();
        return view('mc.cost', ['collections' => $collections ?: [], 'group' => $group ]);
    }
}
