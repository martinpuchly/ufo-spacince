<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $timestamps = false;
    protected $guarded = [];


    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
