<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
    /**
     * Gets the turn in which this attack happened
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function turn()
    {
        return $this->belongsTo(Turn::class);
    }

    /**
     * Gets the attacker who did this attack
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attacker()
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Gets the defender who received this attack
     */
    public function defender()
    {
        return $this->belongsTo(Player::class);
    }
}
