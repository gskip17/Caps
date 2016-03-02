<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\League;
use App\Team;
use App\Players;
use App\ScheduleListing;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LeagueController extends Controller
{
    public function ViewUserLeagues(){

      if(!Auth::check()){
        return redirect('home')->with('status','You must be signed in to view your Leagues.');
      }

      $leagues = League::where('userId',Auth::id())->get();


      return view('pages.leagues_dashboard',compact('leagues','scheduleListings'));

    }

    public function ViewLeague($id){

      $league = League::where('id', $id)->firstOrFail();

      if(Auth::id() != $league->userId){
        return redirect('home')->with('status','Sorry Friend, you do not have access to see this league.');
      }

      $teams = Team::where('leagueId', $league->id)->orderBy('wins')->take(5)->get();

      $schedulelistings = ScheduleListing::where('leagueId',$league->id)->
      orderBy('updated_at')->take(5)->get();


      return view('pages.league', compact('league', 'teams', 'schedulelistings'));

    }

    //Takes a league Id as parameter, check to make sure current user owns the league.
    public function ViewTeams($id){

      $league = League::where('id', $id)->firstOrFail();

      if(Auth::id() != $league->userId){
        return redirect('home')->with('status','Sorry Friend, you do not have access to see this content.');
      }

      $teams = Team::where('leagueId', $league->id)->get();

      return view('pages.teams_dashboard', compact('league','teams'));

    }

}
