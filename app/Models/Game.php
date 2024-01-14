<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'css_class',
        'game_image',
        'game_link',
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