@extends('master')

@section('title','Teams')

@section('content')

<div class="row">
  <div class="col-sm-12">

    @if($teams->count() == 0)
      <div class="alert alert-warning">
        <p>Looks like you haven't created any teams yet.
        Try adding some. You need teams to make a league work after all.</p>
      </div>
      <br>
    @endif

    @if(Session('status'))
      <div class="alert alert-success">
        <p>{{Session('status')}}</p>
      </div>
    @endif

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Your Teams</h3>
      </div>
      <div class="panel-body">

        <table class="table table-striped table-hover">
          <tr>
            <th>Team Name</th>
            <th>Member One</th>
            <th>Member Two</th>
            <th>Wins</th>
            <th>Losses</th>
            <th>View</th>
            <th>Delete</th>
          </tr>
          @foreach($teams as $team)
          <tr>
            <td>{{$team->teamName}}</td>
            <td>{{$team->GetMember1Name()}}</td>
            <td>{{$team->GetMember2Name()}}</td>
            <td>{{$team->wins}}</td>
            <td>{{$team->losses}}</td>
            <td><a href="{{action('LeagueController@ViewTeams',$league->id)}}"><span class = "glyphicon glyphicon-info-sign"></span></a></td>
            <td><a href="{{action('TeamController@DeleteTeam', ['leagueId' => $league->id, 'teamId' => $team->id])}}"><span class="glyphicon glyphicon-remove"</a></td>
          @endforeach
        </table>

        <button id="addTeamButton" class="btn btn-primary">Add Team</button>
        <a href="{{action('LeagueController@ViewLeague',$league->id)}}" class="btn btn-info">Back To League</a>



      </div>
    </div>

  </div>
</div>



@endsection


@section('modal')
<!-- Modal -->
<div class="modal fade" id="addTeamModal" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add A Team</h4>
      </div>

      <form method="post">

      <div class="modal-body">

          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <input type="hidden" name="leagueId" value="{{$league->id}}">
          <div class="form-group">
            <label>Team Name</label>
            <input type="text" name="teamName" class="form-control">
          </div>
          <div class="form-group">
            <label>Member One Name</label>
            <input type="text" name="member1Name" class="form-control">
          </div>
          <div class="form-group">
            <label>Member Two Name</label>
            <input type="text" name="member2Name" class="form-control">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>

    </form>

    </div>
  </div>
</div>
@endsection
