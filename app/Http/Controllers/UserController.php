<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function showProfile($pseudo)
	{
		$user = User::where('name', $pseudo)->first();

		if (!$user) {
        	return redirect()->route('home');
    	}

		return view('profile.show', ['user' => $user]);
	}
	
	public function showMyProfile()
	{
		$user = Auth::user();

		if (!$user) {
			return redirect()->route('home');
		}

		return view('profile.show', ['user' => $user]);
	}
	
	public function showFriends()
{
    return redirect()->route('friends.index');
}
}