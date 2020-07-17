<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use App\Bot;
use App\SmartSwitchDual;

class SmartSwitchDualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show SmartSwitch Dual dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data['all_duals'] = SmartSwitchDual::with('long_bot', 'short_bot')->where('user_id', $user->id)->get();

        return view('pages.smartswitch.dual.index', $data);
    }

    public function show($id)
    {
        $user = Auth::user();
        $smart_switch_duals = SmartSwitchDual::with('long_bot', 'short_bot')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return view('pages.smartswitch.dual.show', compact('smart_switch_duals'));
    }

    public function store(Request $request) {
        $smartswitch_dual = new SmartSwitchDual();

        try {
            $this->validate($request, [
                'name'                  => 'required',
                'long_bot_id'           => 'required',
                'short_bot_id'          => 'required',
                'long_switch_action'    => 'required',
                'short_switch_action'   => 'required',
                'first_long_deal'       => 'required',
                'first_short_deal'      => 'required',
            ]);

            //ensure the long and short bot are for the same coin
            $long_coin = Bot::where('id', $request['long_bot_id'])->get();
            $short_coin = Bot::where('id', $request['short_bot_id'])->get();

            //if ($long_coin['pairs'] != $short_coin['pairs']) {
            //    $errors = ['smartswitch.dual.store' => "mismatch pair"];
            //return redirect()->back()
             //   ->withInput($request->only($request->input('name'), 'name'))
             //   ->withErrors($errors);
            //}

            $smartswitch_dual->fill($request->all());
            $smartswitch_dual->user_id = Auth::user()->id;
            $smartswitch_dual->json_long = '{"id": '. Auth::user()->id . ', "type": "SmartSwitchDual", "token": "' . str_random(8) . '-' . str_random(16) . '", "indicator": "long"}';
            $smartswitch_dual->json_short = '{"id": '. Auth::user()->id . ', "type": "SmartSwitchDual", "token": "' . str_random(8) . '-' . str_random(16) . '", "indicator": "short"}';

            if($smartswitch_dual->save()) {
                //session()->flash('load_deal', encrypt('testing token'));
                return redirect('smartswitch/dual');
            } else {
                return $this->response->error('logo', 500);
            }
        }
        catch (ValidationException $e) {
            $errors = ['smartswitch.dual.store' => $e->getMessage()];
            return redirect()->back()
                ->withInput($request->only($request->input('name'), 'name'))
                ->withErrors($errors);
        }
        catch(Exception $e){
            $errors = ['smartswitch.dual.store' => $e->getMessage()];
            return redirect()->back()
                ->withInput($request->only($request->input('name'), 'name'))
                ->withErrors($errors);
        }
    }

    public function create()
    {
        $user = Auth::user();

        $data['all_long_bots'] = DB::table('bots')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('strategy', 'long')
                ->get();

        $data['all_short_bots'] = DB::table('bots')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('strategy', 'short')
                ->get();

        return view('pages.smartswitch.dual.create', $data);
    }

    public function destroy($id)
    {
        try {
            $sbd = SmartSwitchDual::findOrFail($id);
            $sbd->delete();

            return redirect()->route('martswitch.dual.index')
                             ->with('success_message', 'SwitchBot was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
