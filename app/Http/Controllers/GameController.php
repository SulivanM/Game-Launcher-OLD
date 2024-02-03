<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function show($id)
	{
		$game = Game::find($id);

		if (!$game) {
			abort(404);
		}

		return view('games.show', compact('game'));
	}
}
