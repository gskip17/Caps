<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\League;
use App\Http\Requests;
use App\Http\Requests\LoggedInRequest;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    //
    public function Index(){
        return view('registerleague');
    }

    public function RegisterLeague(LoggedInRequest $request){

      if(!Auth::check()){
        return redirect('registerleague')->with('status','You must be logged to register a league.');
      }

      // Create a new instance of the event
      $league = new League;

      $league->name = $request->get('name');
      $league->userId = $request->get('userId');
      $league->organization = $request->get('organization');
      $league->gamesplayed = $request->get('gamesplayed');
      $league->description = $request->get('description');

      $league->save();

      return redirect(action('LeagueController@ViewLeague', $league->id))
      ->with('status','Congrats, you made a new league! Get started by adding teams then generating a schedule!');

    }
}
