@extends('master')

@section('title', 'View League')

@section('content')

  <div class="row">
    <div class="col-md-12">

      <div class="page-header">
        <h2>{{$league->name}} <small>{{$league->organization}}</small></h2>
      </div>

      <div class="row">
        @if(Session('status'))
          <div class="alert alert-success">{{Session('status')}}</div>
        @endif
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Teams</h3>
            </div>
            <div class="panel-body">
              @if($teams->count() == 0)
              <p>Looks like you havn't created any teams yet, you'd better start
              by adding some. Click on Manage Teams to get started!</p>
              @else
              <h4 class="page-header">Top Teams</h4>
              <table class="table table-striped table-hover">
                <tr>
                  <th>Team Name</th>
                  <th>Wins</th>
                  <th>Losses</th>
                </tr>
                @foreach($teams as $team)
                <tr>
                  <td><a href="#">{{$team->teamName}}</a></td>
                  <td>{{$team->wins}}</td>
                  <td>{{$team->losses}}</td>
                </tr>
                @endforeach
              </table>
              @endif
              <a href="/teamdashboard/{{$league->id}}" class="btn btn-warning">Manage Teams</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Schedule</h3>
            </div>
            <div class="panel-body">
              @if($schedulelistings->count() == 0)
                <p>No schedule has been generated yet. Click on View Schedule then
                generate one!</p>
              @else
              <h4 class="page-header">Recently Updated Games</h4>
              <table class="table table-striped table-hover">
                <tr>
                  <th>Team 1</th>
                  <th>Team 2</th>
                  <th>Result</th>
                  <th>Round</th>
                </tr>
                @foreach($schedulelistings as $listing)
                <tr>
                  <td>{{$listing->GetTeamOneName()}}</td>
                  <td>{{$listing->GetTeamTwoName()}}</td>
                  <td>Not Played</td>
                  <td>{{$listing->round}}</td>
                @endforeach
              </table>
              @endif

              <a href="/leagueschedule/{{$league->id}}"
                class="btn btn-info"> View Schedule </a>

            </div>
          </div>
        </div>


        <div class="col-md-4">
          <div class="well well-lg">
            <h4 class="page-header">Description</h4>
            <p>
              {{$league->description}}
              <span class="glyphicon glyphicon-pencil"></span>
            </p>

          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
