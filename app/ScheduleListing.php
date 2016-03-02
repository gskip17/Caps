<?php

namespace App;

use App\Team;
use Illuminate\Database\Eloquent\Model;

class ScheduleListing extends Model
{
    protected $fillable = [
      'team1Id','team2Id','leagueId','gameId','round','team1Score','team2Score','reported'
    ];

    public function GetTeamOneName(){
      $team = Team::where('id', $this->team1Id)->first();

      return $team->teamName;
    }

    public function GetTeamTwoName(){

      $team = Team::where('id', $this->team2Id)->first();

      if($team == null){
        return "No Game";
      }

      return $team->teamName;
    }
}
