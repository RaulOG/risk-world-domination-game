<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Get the players from the game
     */
    public function players()
    {
        return $this->hasMany('App\Player');
    }
}
