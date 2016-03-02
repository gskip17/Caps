<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ReportGameRequest;
use App\Http\Controllers\Controller;
use App\Team;
use App\Game;
use App\ScheduleListing;
use App\League;
use Auth;
use App\Player;
use App\User;

class GameController extends Controller
{
    public function ReportGame($scheduleId){

      $listing = ScheduleListing::where('id',$scheduleId)->firstOrFail();
      $teamOne = Team::where('id',$listing->team1Id)->firstOrFail();
      $teamTwo = Team::where('id',$listing->team2Id)->firstOrFail();

      return view('pages.team.submit_game', compact('listing','teamOne','teamTwo'));
    }

    public function SubmitGame($scheduleId, ReportGameRequest $request){

      $listing = ScheduleListing::where('id',$scheduleId)->firstOrFail();
      $teamOne = Team::where('id',$listing->team1Id)->firstOrFail();
      $teamTwo = Team::where('id',$listing->team2Id)->firstOrFail();

      $T1P1 = $teamOne->GetMemberOne();
      $T1P2 = $teamOne->GetMemberTwo();

      $T2P1 = $teamTwo->GetMemberOne();
      $T2P2 = $teamTwo->GetMemberTwo();

      $T1P1Cups = $request->get('t1p1Cups');
      $T1P2Cups = $request->get('t1p2Cups');
      $T2P1Cups = $request->get('t2p1Cups');
      $T2P2Cups = $request->get('t2p2Cups');

      //make sure we are okay number wise
      if($T1P1Cups + $T1P2Cups > 9 && $T2P1Cups + $T2P2Cups > 9){
        return redirect(action('GameController@ReportGame', $listing->id))
        ->with('error','Too many cups submitted, make sure you count.');
      }

      //do win/lose calculation
      $teamOneScore = $T1P1Cups + $T1P2Cups;
      $teamTwoScore = $T2P1Cups + $T2P2Cups;
      // logic for updating the database
      if($teamOneScore > $teamTwoScore){
        $teamOne->wins = $teamOne->wins + 1;
        $teamTwo->losses = $teamTwo->losses + 1;
      } elseif ($teamTwoScore > $teamOneScore) {
        $teamOne->losses = $teamOne->losses + 1;
        $teamTwo->wins = $teamTwo->wins + 1;
      }
      $teamOne->save();
      $teamTwo->save();

      //add cups made to each player for stat keeping.
      $T1P1->cupsMade = $T1P1->cupsMade + $T1P1Cups;
      $T1P2->cupsMade = $T1P2->cupsMade + $T2P1Cups;
      $T2P1->cupsMade = $T2P1->cupsMade + $T1P2Cups;
      $T2P2->cupsMade = $T2P2->cupsMade + $T2P2Cups;
      $T1P1->save();
      $T1P2->save();
      $T2P1->save();
      $T2P2->save();

      $listing->team1Score = $teamOneScore;
      $listing->team2Score = $teamTwoScore;
      $listing->reported = true;
      $listing->save();

      return redirect(action('ScheduleController@ViewSchedule', $listing->leagueId));

    }
}
