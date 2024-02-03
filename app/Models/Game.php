<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'game_image',
        'game_link',
        'status',
    ];

    /**
     * Get the route for displaying game details using its ID.
     *
     * @return string
     */
    public function getGameRoute()
    {
        return route('games.show', ['id' => $this->id]);
    }
}