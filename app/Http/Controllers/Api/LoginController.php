<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

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

    public function createUser() {
        $user = User::create([
            "name" => request('name'),
            "username" => request('username'),
            "password" => Hash::make(request('password')),
            "api_token" => request('api_token'),
            "group_id" => request('group_id'),
        ]);

        return response()->json($user->id);

    }
}
