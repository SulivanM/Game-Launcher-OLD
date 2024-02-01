<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Game;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
	{
		$user = Auth::user();

		if ($user->email == null) {
			return view('popup');
		} else {
			$games = Game::all(); // Récupérer tous les jeux vidéo depuis la base de données
			return view('home', compact('games', 'user')); // Passer les jeux vidéo et l'utilisateur à la vue
		}
	}

    public function welcome()
    {
        $totalUsers = User::count();
        return view('welcome', ['totalUsers' => $totalUsers]);
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();
        $existingUser = User::where('email', $request->input('email'))->where('id', '!=', $user->id)->first();

        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'This email is already in use.']);
        }

        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('home');
    }
}
