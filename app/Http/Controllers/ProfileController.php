<?php

namespace App\Http\Controllers;

use Auth;
use Session;

class ProfileController extends Controller
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
        $user = Auth::user();
        return view('pages.profile.index',compact('user',$user));
    }
}
