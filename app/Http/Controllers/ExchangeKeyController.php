<?php

namespace App\Http\Controllers;

use App\ExchangeKey;
use Illuminate\Http\Request;
use Auth;

class ExchangeKeyController extends Controller
{
    public function index() {
        $exchange_keys = Auth::user()->exchange_keys;
        return view('pages.exchangekey.list', compact('exchange_keys'));
    }

    public function create() {
        return view('pages.exchangekey.create');
    }

    public function store(Request $request) {
        $exchange_key = new ExchangeKey();

        try {
            $this->validate($request, [
                'name'          => 'required',
                'api_key'       => 'required|unique:exchange_keys',
                'secret_key'    => 'required|unique:exchange_keys'
            ]);

            $exchange_key->fill($request->all());
            $exchange_key->user_id = Auth::user()->id;

            if($exchange_key->save()) {
                return redirect('exchangekey');
            } else {
                return $this->response->error('logo', 500);
            }
        }
        catch (ValidationException $e) {
            $errors = ['exchangekey.store' => $e->getMessage()];
            return redirect()->back()
                ->withInput($request->only($request->input('name'), 'name'))
                ->withErrors($errors);
        }
        catch(Exception $e){
            $errors = ['exchangekey.store' => $e->getMessage()];
            return redirect()->back()
                ->withInput($request->only($request->input('name'), 'name'))
                ->withErrors($errors);
        }
    }
}
