<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * Get the game that owns the player.
     */
    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    /**
     * Get the user that owns the player.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
