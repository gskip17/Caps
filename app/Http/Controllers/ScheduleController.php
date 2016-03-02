<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoggedInRequest;
use App\League;
use App\Team;
use App\ScheduleListing;
use App\User;
use App\Game;
use Auth;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function ViewSchedule($id){

      $league = League::where('id', $id)->firstOrFail();

      if(Auth::id() != $league->userId){
        return redirect('home')->with('status','Sorry friend, you cannot view this content');
      }

      $scheduleListings = ScheduleListing::where('leagueId', $id)->get();

      return view('pages.schedule.index', compact('league','scheduleListings'));

    }

    public function DeleteSchedule($id){

      $league = League::where('id',$id)->firstOrFail();

      if(Auth::id() != $league->userId){
        return redirect('home')->with('status','Sorry friend, you cannot view this content');
      }

      $listings = ScheduleListing::where('leagueId',$league->id)->delete();

      return redirect(action('ScheduleController@ViewSchedule', $league->id));
    }

    private function CheckIfLeagueHasSchedule($leagueId){
      $listings = ScheduleListing::where('leagueId', $leagueId)->get();
      if($listings->count() >= 1){
        return true;
      }
      return false;
    }

    public function GenerateSchedule(LoggedInRequest $request){

      $rounds = $request->get('rounds');
      $leagueId = $request->get('leagueId');

      $isSchedule = $this->CheckIfLeagueHasSchedule('leagueId');

      $league = League::where('id', $leagueId)->firstOrFail();

      // Yet another check to make sure the correct person is doing this GET
      if($isSchedule == true){
        return redirect(action('LeagueController@ViewLeague', $league->id))
        ->with('status','You already have a schedule, if you want a new one, delete the old one and try again.');
      }

      $league->gamesplayed = $rounds;
      $league->save();

      //Make sure the owner of the league is doing this GET request
      //or things will get fucked
      if(Auth::id() != $league->userId){
        return redirect('home')->with('status','Sorry friend, you cannot view this content');
      }

      $teams = Team::where('leagueId', $league->id)->get();


      // Go through each team and do assign schedule.
      foreach($teams as $team){

        for($i = 1; $i <= $league->gamesplayed; $i++){
          //Check to see if there is already a scheduled game with
          //round $i, if not, assign/create a ScheduleListing
          if($team->HasScheduleListing($i) == true){
            continue;
          }

          $roundListing = $team->GetScheduleListingByRound($i);


          // This section runs when a team is not assigned for that round.
          if($roundListing == null){

            $newListing = new ScheduleListing;

            $newListing->leagueId = $league->id;
            $newListing->team1Id = $team->id;
            $newListing->team2Id = $team->ReturnAvailableTeam($i);
            $newListing->round = $i;

            $newListing->save();

          }

        }

      }

      return redirect(action('ScheduleController@ViewSchedule', $league->id))
      ->with('status','Take a look, if you don\'t like the matchups, just delete the league and reroll it.');


    }
}
