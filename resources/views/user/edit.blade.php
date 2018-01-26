@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit profile for </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Username</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') != NULL ? old('name') : $user->name }}" required autofocus>

                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') != NULL ? old('email') : $user->email }}" required>

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
              <label for="first_name" class="col-md-4 control-label">First Name</label>
              <div class="col-md-6">
                <input id="first-name" type="text" class="form-control" name="first_name" value="{{ old('first_name') != NULL ? old('first_name') : $user->first_name }}" autofocus>
                @if ($errors->has('first_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
              <label for="last_name" class="col-md-4 control-label">Last Name</label>
              <div class="col-md-6">
                <input id="last-name" type="text" class="form-control" name="last_name" value="{{ old('last_name') != NULL ? old('last_name') : $user->last_name }}" autofocus>
                @if ($errors->has('last_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <label for="description" class="col-md-4 control-label">Description</label>
              <div class="col-md-6">
                <textarea id="description" rows="8" class="form-control" name="description" autofocus>
                  {{ old('description') != NULL ? old('description') : $user->description }}
                </textarea>
                @if ($errors->has('description'))
                  <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Password</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                @if (isset($file))
                  <img src="{{ asset("$file->fullpath") }}" />
                  <a href="{{ route('user.avatar.edit', $user->id) }}">Change this avatar</a>
                @else
                  <a href="{{ route('user.avatar.edit', $user->id) }}">Upload an avatar</a>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
