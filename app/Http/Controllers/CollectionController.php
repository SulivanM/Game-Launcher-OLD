<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $games = $user->games;

        return view('collections.index', compact('games'));
    }
}