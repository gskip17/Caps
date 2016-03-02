@extends('master')
@section('title','Register')

@section('content')
  <div class="container col-md-6 col-md-offset-3">
    <div class="well well-component">

      <form class="form-horizontal" method="post">

        @foreach($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
        @endforeach

        {!! csrf_field() !!}
        <fieldset>

          <legend>Register An Account</legend>

          <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" id="name" placeholder="Name" value="{{old('name')}}"name="name">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
              <input type="email" class="form-control" id="email" placeholder="Email" value="{{old('email')}}"name="email">
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-10">
              <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-lg-2 control-label">Confirm Password</label>
            <div class="col-lg-10">
              <input type="password" class="form-control" id="password_confirmation" placeholder="Re-Type Password"name="password_confirmation">
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              <button type="reset" class="btn btn-default" name="reset">Cancel</button>
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
          </div>

        </fieldset>

      </form>

    </div>
  </div>
  @endsection
