@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Showing image</div>
          <div class="panel-body">
            <img class="image" src="{{ asset("$image->filepath") }}"/>
          </div>
          <div class="panel-body">
            <h3>Share your picture</h3>
            <form name="thumbnail" action="/upload/share" method="post">
              {{ csrf_field() }}
              <input type="hidden" name=id value="{{ $image->id }}" />
              <p><input type="checkbox" name="instagram" value="Instagram">Instagram</p>
              <p><input type="checkbox" name="facebook" value="Facebook">Facebook</p>
              <p><input type="checkbox" name="twitter" value="Twitter">Twitter</p>
              <p><input type="submit" class="button" name="upload_thumbnail" value="Share" id="share" /></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
