<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    const STATE_OPEN = 'open';
    const STATE_IN_PROGRESS = 'in_progress';
    const STATE_CLOSED = 'closed';

    /**
     * Get the players from the game
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
