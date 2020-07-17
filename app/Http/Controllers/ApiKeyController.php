<?php

namespace App\Http\Controllers;

use App\ApiKey;
use Illuminate\Http\Request;
use Auth;

class ApiKeyController extends Controller
{
    //

    public function index() {
        $api_keys = Auth::user()->api_keys;
        return view('pages.apikey.list', compact('api_keys'));
    }

    public function create() {
        return view('pages.apikey.create');
    }

    public function store(Request $request) {
        $api_key = new ApiKey();

        try {
            $this->validate($request, [
                'name'  => 'required',
                'api_key' => 'required|unique:api_keys',
                'secret_key' => 'required|unique:api_keys'
            ]);

            $api_key->fill($request->all());
            $api_key->user_id = Auth::user()->id;

            if($api_key->save()) {
                session()->flash('load_deal', encrypt('testing token'));
                return redirect('dashboard');
            } else {
                return $this->response->error('logo', 500);
            }
        }
        catch (ValidationException $e) {
            $errors = ['apikey.store' => $e->getMessage()];
            return redirect()->back()
                ->withInput($request->only($request->input('name'), 'name'))
                ->withErrors($errors);
        }
        catch(Exception $e){
            $errors = ['apikey.store' => $e->getMessage()];
            return redirect()->back()
                ->withInput($request->only($request->input('name'), 'name'))
                ->withErrors($errors);
        }
    }
}
