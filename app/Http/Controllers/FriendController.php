<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\FriendRequestSent;
use App\Events\FriendRequestAccepted;
use App\Events\FriendRequestDeclined;

class FriendController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load('friends');

        return view('friends', compact('user'));
    }

    public function searchFriends(Request $request)
    {
        $user = Auth::user();
        $searchTerm = $request->input('search');

        $searchResults = User::where('name', 'LIKE', "%{$searchTerm}%")
            ->where('id', '<>', $user->id)
            ->get();

        return view('friends', compact('searchResults', 'user'));
    }

    public function sendFriendRequest(User $friend)
    {
        Auth::user()->friends()->attach($friend->id, ['accepted' => 0]);

        // Diffuser l'événement pour informer l'ami de la demande
        broadcast(new FriendRequestSent(Auth::user(), $friend));

        return redirect()->route('friends.index');
    }

    public function acceptFriendRequest(User $friend)
    {
        Auth::user()->acceptFriendRequest($friend);

        // Diffuser l'événement pour informer l'ami de l'acceptation de la demande
        broadcast(new FriendRequestAccepted(Auth::user(), $friend));

        return redirect()->route('friends.index');
    }

    public function declineFriendRequest(User $friend)
    {
        Auth::user()->declineFriendRequest($friend);

        // Diffuser l'événement pour informer l'ami du refus de la demande
        broadcast(new FriendRequestDeclined(Auth::user(), $friend));

        return redirect()->route('friends.index');
    }

    public function removeFriend(User $friend)
    {
        Auth::user()->friends()->detach($friend->id);

        return redirect()->route('friends.index');
    }
}