<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TicketController;
use App\Models\Game;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $games = Game::all();
    return view('welcome', compact('games'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('auth/twitter', [SocialAuthController::class, 'redirectToTwitter'])->name('auth.twitter');
Route::get('auth/twitter/callback', [SocialAuthController::class, 'handleTwitterCallback']);
Route::get('auth/github', [SocialAuthController::class, 'redirectToGitHub'])->name('auth.github');
Route::get('auth/github/callback', [SocialAuthController::class, 'handleGitHubCallback']);
Route::get('auth/discord', [SocialAuthController::class, 'redirectToDiscord'])->name('auth.discord');
Route::get('auth/discord/callback', [SocialAuthController::class, 'handleDiscordCallback']);
Route::post('/update-email', 'App\Http\Controllers\HomeController@updateEmail')->name('update.email');
Route::get('/profile/{pseudo}', [UserController::class, 'showProfile'])->name('profile.show');
Route::get('/profile', [UserController::class, 'showMyProfile'])->middleware('auth')->name('profile');
Route::get('/settings', [SettingsController::class, 'show'])->name('settings.show');
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
	Route::get('/search-friends', [FriendController::class, 'searchFriends'])->name('search.friends');
    Route::post('/send-friend-request/{friend}', [FriendController::class, 'sendFriendRequest'])->name('send.friend.request');
    Route::post('/accept-friend-request/{friend}', [FriendController::class, 'acceptFriendRequest'])->name('accept.friend.request');
    Route::post('/decline-friend-request/{friend}', [FriendController::class, 'declineFriendRequest'])->name('decline.friend.request');
    Route::post('/remove-friend/{friend}', [FriendController::class, 'removeFriend'])->name('remove.friend');

Route::get('/preloader', function () {
    return view('preloader');
});
Route::get('/games', function () {
    $games = Game::all();
    return view('games', compact('games'));
});
Route::get('/collections', function () {
    return view('collections');
});
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
});
Route::get('/suggests', function () {
    return view('suggests');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::patch('/tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
});
Route::get('/support', function () {
    return view('support');
});
Route::get('/downloads', function () {
    return view('downloads');
});