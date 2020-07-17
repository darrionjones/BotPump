<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function update_avatar(Request $request){
		$this->validate($request, [
			'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$user = Auth::user();
		$avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
		$request->avatar->storeAs('avatars',$avatarName);
		$user->avatar = $avatarName;
		$user->save();
		return back()
			->with('success','Profile image uploaded successfuly.');
	}

}
