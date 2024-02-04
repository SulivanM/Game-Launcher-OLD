<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function download($id)
    {
        $game = Game::find($id);

        if (!$game) {
            abort(404);
        }

        $filePath = storage_path("app/games/{$game->game_link}");

        if (file_exists($filePath)) {
            $fileName = $game->game_link;

            return response()->download($filePath, $fileName);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
}