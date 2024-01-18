<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'subject', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}