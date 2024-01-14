<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function show()
    {
        return view('settings', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
			'language' => 'required|string|max:255',
        ]);

        $user->prenom = $request->input('prenom');
        $user->nom = $request->input('nom');
		$user->language = $request->input('language');
        $user->save();

        return redirect()->route('settings.show')->with('success', 'Paramètres mis à jour avec succès.');
    }
}