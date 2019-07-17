<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        return view('frontend.index');
    }

    public function hosting()
    {
        return view('frontend.hosting');
    }

    public function service()
    {
        return view('frontend.service');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function support()
    {
        return view('frontend.support');
    }
}
