<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Twitter.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleTwitterCallback()
    {
        $socialUser = Socialite::driver('twitter')->user();

        $user = User::where('name', $socialUser->getName())->first();

        if (!$user) {
            // Si aucun utilisateur n'est trouvé avec ce nom, rechercher par adresse e-mail
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if (!$user) {
            // Si aucun utilisateur correspondant n'est trouvé, créer un nouveau compte
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(32)),
                'ip' => request()->getClientIp(),
            ]);
        }

        // Mettre à jour l'image de profil existante ou ajouter une nouvelle image de profil
        if ($user->profile_image) {
            // Mettre à jour l'image de profil existante
            // Supprimer l'ancienne image de profil du serveur
            Storage::delete('public/profile_images/' . $user->profile_image);

            // Sauvegarder la nouvelle image de profil sur le serveur
            $imageFilename = $user->id . '-' . Str::random(10) . '.jpg';
            Storage::put('public/profile_images/' . $imageFilename, file_get_contents($socialUser->getAvatar()));

            // Mettre à jour le chemin de l'image de profil dans la base de données
            $user->profile_image = $imageFilename;
            $user->save();
        } else {
            // Ajouter une nouvelle image de profil si aucune n'existe
            $imageFilename = $user->id . '-' . Str::random(10) . '.jpg';
            Storage::put('public/profile_images/' . $imageFilename, file_get_contents($socialUser->getAvatar()));

            // Mettre à jour le chemin de l'image de profil dans la base de données
            $user->profile_image = $imageFilename;
            $user->save();
        }

        // Log in the user
        auth()->login($user);

        // Redirect to the user's home page
        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGitHubCallback()
    {
        $socialUser = Socialite::driver('github')->user();
        $username = $socialUser->getNickname();

        $user = User::where('name', $username)->first();

        if (!$user) {
            // Si aucun utilisateur n'est trouvé avec ce nom d'utilisateur GitHub, rechercher par adresse e-mail
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if (!$user) {
            // Si aucun utilisateur correspondant n'est trouvé, créer un nouveau compte
            $user = User::create([
                'name' => $username,
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(32)),
                'ip' => request()->getClientIp(),
            ]);
        }

        // Mettre à jour l'image de profil existante ou ajouter une nouvelle image de profil
        if ($user->profile_image) {
            // Mettre à jour l'image de profil existante
            // Supprimer l'ancienne image de profil du serveur
            Storage::delete('public/profile_images/' . $user->profile_image);

            // Sauvegarder la nouvelle image de profil sur le serveur
            $imageFilename = $user->id . '-' . Str::random(10) . '.jpg';
            Storage::put('public/profile_images/' . $imageFilename, file_get_contents($socialUser->getAvatar()));

            // Mettre à jour le chemin de l'image de profil dans la base de données
            $user->profile_image = $imageFilename;
            $user->save();
        } else {
            // Ajouter une nouvelle image de profil si aucune n'existe
            $imageFilename = $user->id . '-' . Str::random(10) . '.jpg';
            Storage::put('public/profile_images/' . $imageFilename, file_get_contents($socialUser->getAvatar()));

            // Mettre à jour le chemin de l'image de profil dans la base de données
            $user->profile_image = $imageFilename;
            $user->save();
        }

        // Log in the user
        auth()->login($user);

        // Redirect to the user's home page
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Redirect the user to the Discord authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * Obtain the user information from Discord.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleDiscordCallback()
    {
        $socialUser = Socialite::driver('discord')->user();

        $user = User::where('name', $socialUser->getName())->first();

        if (!$user) {
            // Si aucun utilisateur n'est trouvé avec ce nom, rechercher par adresse e-mail
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if (!$user) {
            // Si aucun utilisateur correspondant n'est trouvé, créer un nouveau compte
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(32)),
                'ip' => request()->getClientIp(),
            ]);
        }

        // Mettre à jour l'image de profil existante ou ajouter une nouvelle image de profil
        if ($user->profile_image) {
            // Mettre à jour l'image de profil existante
            // Supprimer l'ancienne image de profil du serveur
            Storage::delete('public/profile_images/' . $user->profile_image);

            // Sauvegarder la nouvelle image de profil sur le serveur
            $imageFilename = $user->id . '-' . Str::random(10) . '.jpg';
            Storage::put('public/profile_images/' . $imageFilename, file_get_contents($socialUser->getAvatar()));

            // Mettre à jour le chemin de l'image de profil dans la base de données
            $user->profile_image = $imageFilename;
            $user->save();
        } else {
            // Ajouter une nouvelle image de profil si aucune n'existe
            $imageFilename = $user->id . '-' . Str::random(10) . '.jpg';
            Storage::put('public/profile_images/' . $imageFilename, file_get_contents($socialUser->getAvatar()));

            // Mettre à jour le chemin de l'image de profil dans la base de données
            $user->profile_image = $imageFilename;
            $user->save();
        }

        // Log in the user
        auth()->login($user);

        // Redirect to the user's home page
        return redirect(RouteServiceProvider::HOME);
    }

}