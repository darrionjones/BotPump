<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Dashboard;
use Auth;
use Session;
use DB;

class DashboardController extends Controller
{
    //
    use Dashboard;

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
        $data = $this->dashboardData();

        return view('dashboard', $data);
    }

    public function data() {
        $data = $this->dashboardData();

        return response()->json($data);
    }
}
