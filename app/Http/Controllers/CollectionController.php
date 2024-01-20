<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $games = $user->games;
            return view('/collections', compact('games'));
        }
    }

    public function addToCollection($gameId)
    {
        $user = auth()->user();
        $game = Game::find($gameId);

        if ($user && $game) {
            if (!$user->games->contains($game->id)) {
                $user->games()->attach($game->id);

                return Redirect::to('/collections');
            } else {
                return Redirect::to('/collections');
            }
        }

        return Redirect::to('/collections');
    }
}