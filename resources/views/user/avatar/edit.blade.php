@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Upload an avatar</div>
          <div class="panel-body">
            <form method="post" enctype="multipart/form-data" action="{{ route('user.avatar.update', $user->id) }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="file" name="image" />
                @if ($errors->has('image'))
                  <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <input type="submit" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
