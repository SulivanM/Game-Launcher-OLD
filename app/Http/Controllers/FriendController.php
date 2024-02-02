<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $friends = $user->friends;
        $friendRequests = $user->friendRequests;
        $users = User::where('id', '!=', $user->id)->get();

        return view('friends', compact('user', 'friends', 'friendRequests', 'users'));
    }

    public function sendFriendRequest(Request $request)
    {
        $friendId = $request->input('friend_id');
        $user = auth()->user();

        // Vérifiez d'abord si une demande d'amitié similaire existe déjà
        $existingRequest = DB::table('friends')
            ->where('user_id', $user->id)
            ->where('friend_id', $friendId)
            ->where('accepted', 0)
            ->exists();

        if (!$existingRequest) {
            $user->friends()->attach($friendId, ['accepted' => 0]);
        }

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