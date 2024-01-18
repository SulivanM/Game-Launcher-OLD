<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatabl
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
            ->withPivot('accepted')
            ->with('friends'); // Charger les informations complètes des amis
    }


    public function friendRequests()
{
    return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
        ->using(Friendship::class)
        ->withPivot('accepted')
        ->wherePivot('accepted', 0);
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
}
