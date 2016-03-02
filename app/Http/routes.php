<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::group(['middleware' => ['web']], function () {
    Route::get('home','Home@Index');
    Route::get('/', 'Home@Index');
    Route::get('users/login', 'Auth\AuthController@getLogin');
    Route::post('users/login', 'Auth\AuthController@postLogin');
    Route::get('users/register', 'Auth\AuthController@getRegister');
    Route::post('users/register', 'Auth\AuthController@postRegister');
    Route::get('users/logout', 'Auth\AuthController@logout');
    Route::get('registerleague', 'RegistrationController@Index');
    Route::post('registerleague', 'RegistrationController@RegisterLeague');
    Route::get('about','Home@About');
    Route::get('myleagues','LeagueController@ViewUserLeagues');
    Route::get('viewleague/{id}','LeagueController@ViewLeague');
    Route::get('teamdashboard/{id}','LeagueController@ViewTeams');
    Route::post('teamdashboard/{id}', 'TeamController@AddTeam');
    Route::get('deleteteam/{leagueId}/{teamId}', 'TeamController@DeleteTeam');
    Route::get('leagueschedule/{id}','ScheduleController@ViewSchedule');
    Route::post('leagueschedule/{id}', 'ScheduleController@GenerateSchedule');
    Route::get('leagueschedule/deleteschedule/{id}','ScheduleController@DeleteSchedule');
    Route::get('reportgame/{id}','GameController@ReportGame');
    Route::post('reportgame/{id}','GameController@SubmitGame');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
