@extends('master')

@section('title','Schedule')

@section('content')
  @if(Session('status'))
  <div class="alert alert-success">
    {{Session('status')}}
  </div>
  @endif
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Schedule</h3>
        </div>
        <div class="panel-body">
          @if($scheduleListings->count() == 0)
          <p>Looks like you dont have a schedule yet.<p>
          <form method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="leagueId" value="{{$league->id}}">
            <div class="form-group">
              <label>Rounds</label>
              <input type="integer" name="rounds" class="form-control" value="{{$league->gamesplayed}}">
            </div>
            <div class="alert alert-warning">
              <p>'Rounds' is how many 'weeks' are in the league will play. We decided
              that caps games are best played on your own time so we do not enforce playing on by
                a certain date.
              </p>
              <p> Based on how the algorithm generates your schedule, certain teams may have 'bye' weeks</p>
              <p>After you generate a league, it is finalized, if you want to add teams you will have to
                delete this schedule and create a new one - all stats will be deleted</p>
              <p>The League schedule is generated with an aspect of randomness, if you don't like your initial schedule, try
                deleting it and generating another one. It is mathematically impossible for every team will play every team
                if your league has more teams than rounds. Also, because of the randomness, teams may play each other
                multiple times while maybe never playing another team.</p>

            </div>
            <button type="submit" class="btn btn-info">Generate Schedule</button>
            <a href="{{action('LeagueController@ViewLeague',$league->id)}}" class="btn btn-primary">Go Back</a>
          </form>

          @endif
          @if($scheduleListings->count())
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            @for($i = 1; $i <= $league->gamesplayed; $i++)


                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="heading{{$i}}">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                        View Round {{$i}}
                      </a>
                    </h4>
                  </div>
                  <div id="collapse{{$i}}" class="panel-collapse accord collapse in" role="tabpanel" aria-labelledby="heading{{$i}}">
                    <div class="panel-body">
                      <table class="table table-striped table-hover">
                        <tr>
                          <th>Team One</th>
                          <th>Team Two</th>
                          <th>Round</th>
                          <th>Result</th>
                          <th>Report Game</th>
                        </tr>
                        @foreach($scheduleListings as $listing)
                        @if($listing->GetTeamTwoName() == "No Game")
                        @elseif($listing->round == $i)
                        <tr>
                          <td>{{$listing->GetTeamOneName()}}</td>
                          <td>{{$listing->GetTeamTwoName()}}</td>
                          <td>{{$i}}</td>
                          <td>{{$listing->team1Score}} - {{$listing->team2Score}}</td>
                          <td><a href="{{action('GameController@ReportGame', $listing->id)}}"><span class="gylphicon glyphicon-pencil"></span></a></td>
                        @endif
                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
            @endfor
            <br>
            <a href="{{action('LeagueController@ViewLeague',$league->id)}}" class="btn btn-primary">Go Back</a>
            <button type="button" id="deleteSchedule" data-toggle="modal" data-target="#deleteModal" class="btn btn-warning">Delete Schedule</button>
          </div>
          @endif

        </div>
      </div>

    </div>
  </div>
@endsection

@section('modal')

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Are you sure you want to delete your scheule?</h4>
      </div>
      <div class="modal-body">
        If you do this, you will need to generate another schedule. All stats associated with teams in this schedule will be deleted.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Nevermind</button>
        <a href="deleteschedule/{{$league->id}}" class="btn btn-primary">Yep, delete it.</a>
      </div>
    </div>
  </div>
</div>

@endsection
