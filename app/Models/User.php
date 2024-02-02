<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'prenom',
        'nom',
        'language',
        'dcoin',
        'color',
        'ip',
        'date_creation',
        'trophies',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('accepted');
    }

    public function sendFriendRequest(Request $request)
    {
        $friendId = $request->input('friend_id');
        $friend = User::findOrFail($friendId);
        auth()->user()->friends()->attach($friend->id, ['accepted' => 0]);

        return redirect()->route('friends.index');
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->updateExistingPivot($user->id, ['accepted' => 1]);
    }

    public function declineFriendRequest(User $user)
    {
        $this->friendRequests()->detach($user->id);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, 'user_games')->withTimestamps();
    }

}
