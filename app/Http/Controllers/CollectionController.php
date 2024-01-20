<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $games = $user->games;

        return view('collections.index', compact('games'));
    }

    public function addToCollection($gameId)
    {
        $user = auth()->user();
        $game = Game::find($gameId);

        if ($user && $game) {
            $user->games()->attach($game->id);
        }

        return redirect()->route('games');
    }
}