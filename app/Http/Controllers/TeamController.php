<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoggedInRequest;
use App\Http\Controllers\Controller;
use App\Team;
use App\Player;
use App\League;
use App\User;
use Auth;

class TeamController extends Controller
{
    public function Index($id){

      $league = League::where('id', $id)->firstOrFail();

      if(Auth::id() != $league->userId){
        return redirect('home')->with('status','Sorry Friend, you do not have access to see this content.');
      }

      $teams = Team::where('leagueId', $league->id)->get();

      return view('pages.teams_dashboard', compact('league','teams'));

    }

    public function AddTeam(LoggedInRequest $request){

      //Get stuff from form
      $leagueId = $request->get('leagueId');
      $teamName = $request->get('teamName');

      $member1Name = $request->get('member1Name');
      $member2Name = $request->get('member2Name');

      // Create new player 1
      $newPlayer1 = new Player;

      $newPlayer1->name = $member1Name;
      $newPlayer1->leagueId = $leagueId;

      $newPlayer1->save();

      // Create new player 2
      $newPlayer2 = new Player;

      $newPlayer2->name = $member2Name;
      $newPlayer2->leagueId = $leagueId;

      $newPlayer2->save();

      // Create new Team
      $newTeam = new Team;

      $newTeam->teamName = $teamName;
      $newTeam->member1Id = $newPlayer1->id;
      $newTeam->member2Id = $newPlayer2->id;
      $newTeam->leagueId = $leagueId;

      $newTeam->save();

      // Assign Players to newly created team
      $newPlayer1->teamId = $newTeam->id;
      $newPlayer2->teamId = $newTeam->id;

      $newPlayer1->save();
      $newPlayer2->save();

      return redirect(action('LeagueController@ViewTeams',$leagueId))
      ->with('status','Team Successfully Added To League');

    }

    public function DeleteTeam($leagueId, $teamId){

      $league = League::where('id',$leagueId)->firstOrFail();
      $ownedBy = $league->userId;

      //Because it is a Get request, we need to make sure the user can actually
      //do this..
      if(Auth::id() != $ownedBy){
        return redirect('home')->with('status','Sorry, you cannot do that');
      }

      // Do the deed
      $team = Team::where('id',$teamId);
      $team->delete();

      // Deed is done.
      return redirect(action('LeagueController@ViewTeams', $leagueId))
      ->with('status','Team Deleted From League - All Games associated with them are now'+
      ' removed from the schedule.');

    }
}
