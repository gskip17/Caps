@extends('master')

@section('title','Submit Game')

@section('content')
@if(Session('error'))
  <div class="alert alert-danger">{{Session('error')}}</div>
@endif
<div class="row">
  <div class="col-md-4">
      <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Submitting A Game</h3>
      </div>
      <div class="panel-body">
        <p>It's Simple(Dom)!
          <ul>
            <li>Each team's cups may not exceed 9 (that's how you play caps)</li>
            <li>Each member needs to account for cups made (even 0 if they suck)</li>
            <li>There is no overtime, deal with it.</li>
          </ul>
        </p>
      </div>
      </div>
  </div>
  <div class="col-md-4">
    <h2 class="page-header">Report Game</h4>
    <form method="post">
      <input type="hidden" name="_token" value="{!! csrf_token() !!}">
      <input type="hidden" name="userId" value="{{Auth::id()}}">
      <input type="hidden" name="leagueId" value="{{$listing->id}}">
      <div class="form-group">
        <h4 class="page-header">{{$listing->GetTeamOneName()}}</h4>
        <label>{{$teamOne->GetMember1Name()}}'s Cups Made</label>
        <input type="number" name="t1p1Cups" class="form-control" value="0" max="9" min="0">
        <label>{{$teamOne->GetMember2Name()}}'s Cups Made</label>
        <input type="number" name="t1p2Cups" class="form-control" value="0" max="9" min="0">
      </div>
      <div class="form-group">
        <h4 class="page-header">{{$listing->GetTeamTwoName()}}</h4>
        <label>{{$teamTwo->GetMember1Name()}}'s Cups Made</label>
        <input type="number" name="t2p1Cups" class="form-control" value="0" max="9" min="0">
        <label>{{$teamTwo->GetMember2Name()}}'s Cups Made</label>
        <input type="number" name="t2p2Cups" class="form-control" value="0" max="9" min="0">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit Game</button>
      <a href="{{action('LeagueController@ViewLeague',$listing->leagueId)}}" class="btn btn-danger">Back To League</a>
    </form>
  </div>
</div>
@endsection
