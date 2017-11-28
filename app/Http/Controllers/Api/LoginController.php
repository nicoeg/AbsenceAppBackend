<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class LoginController extends Controller
{
    public function store() {
    	$validated = $this->validate(request(), [
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	if (!\Auth::attempt($validated)) {
    		return response()->json('Wrong credentials', 403);
    	}

    	return response()->json(User::where('username', request('username'))->first());
    }
}
