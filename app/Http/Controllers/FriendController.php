<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $friends = $user->friends;
        $friendRequests = $user->friendRequests;

        return view('friends', compact('user', 'friends', 'friendRequests'));
    }

    public function sendFriendRequest(User $friend)
    {
        auth()->user()->friends()->attach($friend->id, ['accepted' => 0]);

        return redirect()->route('friends.index');
    }

    public function acceptFriendRequest(User $friend)
    {
        auth()->user()->acceptFriendRequest($friend);

        return redirect()->route('friends.index');
    }

    public function declineFriendRequest(User $friend)
    {
        auth()->user()->declineFriendRequest($friend);

        return redirect()->route('friends.index');
    }
}