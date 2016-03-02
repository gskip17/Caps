@extends('master')

@section('title', "DPU Caps")

@section('content')
@if(Session('status'))
<div class="alert alert-danger">{{Session('status')}}</div>
@endif
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
              <h1>Register A League <small>D3 dreams live here.</small></h1>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-6">
                <div class="well">

                    <form method="post">
                       <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                       <input type="hidden" name="userId" value="{{Auth::id()}}">
                       <div class="form-group">
                         <label>League Name</label>
                         <input type="text" name="name" class="form-control" value="{{old('name')}}">
                       </div>
                       <div class="form-group">
                         <label>League Organization</label>
                         <input type="text" name="organization" class="form-control" value="{{old('organization')}}">
                       </div>
                       <div class="form-group">
                         <label>Rounds</label>
                         <input type="number" name="gamesplayed" class="form-control" value="{{old('gamesplayed')}}">
                       </div>
                       <div class="form-group">
                         <label> Description </label>
                         <textarea name="description" class="form-control" placeholder="Ex. 'Plays twice a week', 'Hamms or GTFO', 'Guy Girl teams', 'Us vs. DG', etc. " row="5">{{old('description')}}</textarea>
                       </div>
                       <br>
                       <button type="submit" class="btn btn-primary">Submit</button>
                       <a href="home" class="btn btn-danger">Cancel</a>
                     </form>

                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Getting Started</h3>
                  </div>
                  <div class="panel-body">
                    <p>Once you let CapsIM know the basic details about your league, you will then be able to start composing teams. After each game is played
                    just log in and report the results. CapsIM will handle 'who plays who' each round/week, and even track stats down to the
                    player level. Your league will be linked to the account that created it, so try to remember it. We have found that it is easiest
                    to make a throwaway email and give the credentials to all the players in the league so everybody can report scores. It's up to
                    you to keep participants honest.<p>
                    <br>
                    <i>'Silver or Lead' - Pablo Escobar.</i>
                  </div>
                </div>
            </div>
        </div>
<div>

@endsection
