<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Game;
use App\Models\User;
use App\Models\Ticket;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Define routes for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public static function routes(User $user)
    {
        Route::get('/', function () {
            $games = Game::all();
            return view('welcome', compact('games'));
        });

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('auth/twitter', [SocialAuthController::class, 'redirectToTwitter'])->name('auth.twitter');
        Route::get('auth/twitter/callback', [SocialAuthController::class, 'handleTwitterCallback']);
        Route::get('auth/github', [SocialAuthController::class, 'redirectToGitHub'])->name('auth.github');
        Route::get('auth/github/callback', [SocialAuthController::class, 'handleGitHubCallback']);
        Route::get('auth/discord', [SocialAuthController::class, 'redirectToDiscord'])->name('auth.discord');
        Route::get('auth/discord/callback', [SocialAuthController::class, 'handleDiscordCallback']);
        Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/update-email', 'App\Http\Controllers\HomeController@updateEmail')->name('update.email');
        Route::post('/settings/updateprofile', [SettingsController::class, 'updateprofile'])->name('settings.updateprofile');
        Route::post('/settings/updatelauncher', [SettingsController::class, 'updatelauncher'])->name('settings.updatelauncher');
        Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('/send-friend-request/{friend}', [FriendController::class, 'sendFriendRequest'])->name('send.friend.request');
        Route::post('/accept-friend-request/{friend}', [FriendController::class, 'acceptFriendRequest'])->name('accept.friend.request');
        Route::post('/decline-friend-request/{friend}', [FriendController::class, 'declineFriendRequest'])->name('decline.friend.request');
        Route::post('/remove-friend/{friend}', [FriendController::class, 'removeFriend'])->name('remove.friend');

        Route::get('/preloader', function () {
            return view('preloader');
        });

        Route::middleware(['auth'])->group(function () {
            Route::get('/games', function () {
                $games = Game::all();
                return view('games', compact('games'));
            });
            Route::get('/profile', [UserController::class, 'showMyProfile'])->middleware('auth')->name('profile');
            Route::get('/settings', [SettingsController::class, 'show'])->name('settings.show');
            Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
            Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
            Route::get('/search-friends', [FriendController::class, 'searchFriends'])->name('search.friends');
            Route::get('/profile/{pseudo}', [UserController::class, 'showProfile'])->name('profile.show');
            Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
            Route::post('/collections/add/{gameId}', 'App\Http\Controllers\CollectionController@addToCollection')->name('collections.add');
            Route::get('/notifications', function () {
                return view('notifications');
            });
            Route::get('/trophy', function () {
                return view('trophy');
            });
            Route::get('/tchat', [ChatController::class, 'index'])->name('chat.index');
            Route::post('/tchat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send');

            Route::get('/streams', function () {
                return view('streams');
            });
            Route::get('/balance', function () {
                return view('balance');
            })->name('balance')->middleware('auth');
            Route::get('/paypal/payment', [PayPalController::class, 'index'])->name('paypal.payment');
            Route::post('/paypal/payment', [PayPalController::class, 'payment']);
            Route::get('/paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
            Route::get('/paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment.cancel');
            Route::get('/suggests', function () {
                return view('suggests');
            });
            Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
            Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
            Route::patch('/tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
            Route::get('/support', function () {
                $user = auth()->user();
                return view('support', compact('user'));
            });
            Route::get('/downloads', function () {
                return view('downloads');
            });
        });
    }
}