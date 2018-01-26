@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Showing image</div>
          <div class="panel-body">
            <img class="image" src="{{ asset("$file->path640") }}"/>
          </div>
          <div class="panel-body">
            <h3>Share your picture</h3>
            <form name="thumbnail" action="/upload/share" method="post">
              {{ csrf_field() }}
              <input type="hidden" name=file_id value="{{ $file->id }}" />
              <input type="hidden" name=post_id value="{{ $post->id }}" />
              <counted-textarea
                :max-characters="250"
                rows="4"
                cols="50"
                placeholder="Add a caption"
                name="caption"
                v-model="captionText">
              </counted-textarea>
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
