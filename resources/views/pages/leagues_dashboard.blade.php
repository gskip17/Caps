@extends('master')
@section('title','My Leagues')

@section('content')

<div class="row">
  <div class="col-sm-12">

    @if($leagues->count() == 0)
      <div class="alert alert-success">
        <p>Sorry Friend, you haven't created any leagues yet,
          get started by clicking the register button in the Nav
          or home page</p>
      </div>
    @endif

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Your Leagues</h3>
      </div>
      <div class="panel-body">

        <table class="table table-striped table-hover">
          <tr>
            <th>League Name</th>
            <th>Organization</th>
            <th>Rounds</th>
            <th>Description</th>
            <th>View</th>
          </tr>
          @foreach($leagues as $league)
          <tr>
            <td>{{$league->name}}</td>
            <td>{{$league->organization}}</td>
            <td>{{$league->gamesplayed}}</td>
            <td>{{$league->description}}</td>
            <td><a href="{{action('LeagueController@ViewLeague',$league->id)}}"><span class = "glyphicon glyphicon-info-sign"></span></a></td>
          @endforeach
        </table>


      </div>
    </div>

  </div>
</div>

@endsection
