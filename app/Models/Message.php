<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'message']; // Assurez-vous que les colonnes sont incluses ici

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
