<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
  protected $fillable = [
      'name', 'organization', 'userId', 'description','gamesplayed'
      ];

  public function user(){
      $this->belongsTo('App\User');
  }
}
