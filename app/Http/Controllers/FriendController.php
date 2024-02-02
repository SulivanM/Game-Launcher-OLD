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

        $users = User::whereNotIn('id', $friends->pluck('id')->merge($friendRequests->pluck('id')))
            ->where('id', '!=', $user->id)
            ->get();

        return view('friends', compact('user', 'friends', 'friendRequests', 'users'));
    }


    public function sendFriendRequest(Request $request)
    {
        $friendId = $request->input('friend_id');
        $user = auth()->user();

        $existingRequest = $user->friendRequests()->where('friend_id', $friendId)->exists();

        if (!$existingRequest) {
            $user->friends()->attach($friendId, ['accepted' => 0]);
        }

        return redirect()->route('friends.index');
    }

    public function acceptFriendRequest(User $friend)
    {
        $currentUser = auth()->user();

        $currentUser->acceptFriendRequest($friend);
        $friend->acceptFriendRequest($currentUser);

        $currentTime = now()->toDateTimeString();

        $currentUser->friends()->updateExistingPivot($friend->id, ['accepted' => 1, 'updated_at' => $currentTime]);
        $friend->friends()->updateExistingPivot($currentUser->id, ['accepted' => 1, 'updated_at' => $currentTime]);

        return redirect()->route('friends.index');
    }


    public function declineFriendRequest(User $friend)
    {
        auth()->user()->declineFriendRequest($friend);

        return redirect()->route('friends.index');
    }
}