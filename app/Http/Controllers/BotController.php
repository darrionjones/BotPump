<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use DB;
use App\Bot;
use App\Deal;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show All Bots.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {

            $data['bots'] = DB::table('bots')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->orderBy('is_enabled', 'desc')
                ->get(); //This query should only show bots


            return view('pages.bot.list', $data);
        }

     }

    public function show($id)
    {
        $bot = Bot::findOrFail($id);

        return view('pages.bot.show', compact('bot'));
    }
}
