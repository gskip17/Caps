@extends('master')
@section('title','Login')

@section('content')

<div class="container col-md-6 col-md-offset-3 text-center">
  <div class="well well bs-component">

    <form class="form-horizontal" method="post">

      <!-- @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
      @endforeach --!>

      @if(session('status'))
        <p class="alert alert-success"> {{session('status')}}</p>
      @endif

      {!! csrf_field() !!}

      <fieldset>

        <legend>Login</legend>

        <div class="form-group">
          <label for="email" class="col-lg-2 control-label">Email</label>
          <div class="col-lg-10">
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
          </div>
        </div>

        <div class="form-group">
          <label for="password" class="col-lg-2 control-label">Password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember"> Remember Me?
          </label>
        </div>

        <br>

        <div class="form-group">
          <div class="col-lg-10">
            <button type="submit" class="btn btn-primary" name="login">Login</button>
          </div>
        </div>

      </fieldset>

    </form>

  </div>
</div>

@endsection
