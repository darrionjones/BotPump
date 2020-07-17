<?php

namespace App\Http\Controllers;

use Auth;
use Session;

class PlanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.plan.index');
    }
}
