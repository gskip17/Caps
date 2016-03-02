@extends('master')

@section('title', "Home")

@section('content')

<div class="main">
    @if($user)
    <p> Welcome {!! $user->name !!} </p>
    @endif
    @if(session('status'))
     <div class="alert alert-success">
       {{ session('status')}}
     </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
              <h1>Your place to find, organize, and enjoy your Weekday afternoon caps sesh.</h1>
              <p>because you don't have THAT much homework anyway.</p>
              <p><a class="btn btn-primary btn-lg" href="{{action('RegistrationController@Index')}}" role="button">Register A League Now!</a></p>
              <p><a class="btn btn-warning btn-lg" href="{{action('LeagueController@ViewUserLeagues')}}" role="button">View Your Leagues!</a></p>
            </div>
        </div>

    </div>
<div>

@endsection
