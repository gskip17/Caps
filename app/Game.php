<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'homescore', 'awayscore', 'creatorId', 'round','venue','leagueId'
        ];

    public function user(){
        $this->belongsTo('App\User');
    }
}
