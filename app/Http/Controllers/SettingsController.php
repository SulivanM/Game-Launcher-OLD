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
            'color' => 'nullable|string|max:7',
        ]);

        $user->prenom = $request->input('prenom');
        $user->nom = $request->input('nom');
        $user->language = $request->input('language');

        // Vérifie si la couleur est définie dans la requête et la met à jour
        if ($request->has('color')) {
            $color = $request->input('color');
            $user->color = $color;
            dd($color); // Ajoutez cette ligne pour déboguer la couleur avant la mise à jour
        }

        $user->save();

        dd($user->color); // Ajoutez cette ligne pour déboguer la couleur après la mise à jour

        return redirect()->route('settings.show')->with('success', 'Paramètres mis à jour avec succès.');
    }
}