<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ScheduleListing;
use DB;
use App\Player;

class Team extends Model
{
  protected $fillable = [
      'member1Id', 'member2Id', 'leagueId','wins','losses','teamName'
  ];

  public function Players(){
    $this->hasMany('App\Player');
  }

  public function GetMemberOne(){
    $player = Player::where('id', $this->member1Id)->firstOrFail();
    return $player;
  }
  public function GetMemberTwo(){
    $player = Player::where('id', $this->member1Id)->firstOrFail();
    return $player;
  }

  // Returns the name of player 1
  public function GetMember1Name(){
    $player = Player::where('id', $this->member1Id)->firstOrFail();

    $player1Name = $player->name;

    return $player1Name;
  }

  // Returns the name of player 2
  public function GetMember2Name(){
    $player = Player::where('id', $this->member2Id)->firstOrFail();

    $player2Name = $player->name;

    return $player2Name;
  }

  public function GetScheduleListingByRound($round){
    // Grabs the round that has the team in it.
    try {
      $listing =
      ScheduleListing::whereRaw('(team1Id = ' .$this->id.' OR team2Id = '.$this->id.') AND round = '.$round.'')
      ->first();

      return $listing;

    } catch (Exception $e){

    }

    return null;

  }

  public function HasScheduleListing($round){

    if($this->GetScheduleListingByRound($round) != null){
      return true;
    }

    return false;

  }

  public function ReturnAvailableTeam($round){

    $teams = Team::where('leagueId', $this->leagueId)->get();
    $teamIdArray = array();

    foreach($teams as $team){
      $check =
      ScheduleListing::whereRaw('(team1Id = ' .$this->id.' OR team2Id = '.$this->id.') AND round = '.$round.'')
      ->get();

      if ($check->count() == 0){
        array_push($teamIdArray, $team->id);
      }

    }

    if(($id = array_search($this->id, $teamIdArray)) !== false) {
        unset($teamIdArray[$id]);
    }

    $reIndexedArray = array_values($teamIdArray);
    //$reIndexedArray = array_rand($reIndexedArray, count($reIndexedArray));

    $randTeamId = $reIndexedArray[rand( 0 ,count($reIndexedArray)-1)];

    $id = $this->IsTeamAvailable($reIndexedArray, $round);

    if($id == null){
      return null;
    }

    return $id;

  }

  //helper function for ReturnAvailableTeam. Recursive. Having Timeout issues.
  private function IsTeamAvailable($array, $round){

    if(count($array) == 0){
      return null;
    }

    $id = $array[rand( 0 , sizeof($array)-1)];

    if(count($array) == 1 && $array[0] == $id){
      return null;
    }

    $team = Team::where('id',$id)->firstOrFail();


    if($team->HasScheduleListing($round) == true){
      if(($key = array_search($id, $array)) !== false) {
          unset($array[$key]);
      }
      $array = array_values($array);
      $id = $this->IsTeamAvailable($array, $round);
    }

    return $id;
  }

}
