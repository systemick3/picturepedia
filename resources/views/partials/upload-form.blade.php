<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Upload {{ \Route::current()->getName() == 'user.avatar.edit' ? 'an avatar.' : 'a picture.' }}</div>
          <div class="panel-body">
            @if ($errors->hasAny('errors'))
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->get('errors') as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if ($errors->hasAny('warnings'))
              <div class="alert alert-warning">
                <ul>
                  @foreach($errors->get('warnings') as $warning)
                    <li>{{ $warning }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="post" enctype="multipart/form-data">
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
                <input type="submit" class="btn btn-primary" value="Upload"/>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
