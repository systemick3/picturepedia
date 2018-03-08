@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Showing image</div>
          <div class="panel-body">
            <p>You have uploaded {{ $file_count }} {{ str_plural('file', $file_count) }}</p>
            @if (count($thumbnails) > 1)
              @foreach ($thumbnails as $thumbnail)
                <div class="col-md-2">
                  <img src="{{ asset($thumbnail->path80 )}}" />
                </div>
              @endforeach
            @endif
          </div>
          <div class="panel-body">
            <img class="image" src="{{ asset("$file->path640") }}"/>
          </div>
          <div class="panel-body">
            <h3>Share your picture</h3>
            <form name="share" action="/upload/share" method="post">
              {{ csrf_field() }}
              <input type="hidden" name=file_id value="{{ $file->id }}" />
              <input type="hidden" name=post_id value="{{ $post->id }}" />
              <counted-textarea
                :max-characters="250"
                rows="4"
                cols="50"
                placeholder="Add a caption"
                :existing="'{{ $caption }}'"
                name="caption">
              </counted-textarea>
              <p>
                <input id="facebook" type="checkbox" name="facebook" value="Facebook" {{ ($facebook == 1) ? 'checked' : '' }}>
                <label for="facebook">Facebook</label>
              </p>
              <p>
                <input id="twitter" type="checkbox" name="twitter" value="Twitter" {{ ($twitter == 1) ? 'checked' : '' }}>
                <label for="twitter">Twitter</label>
              </p>
              @if ($add_more)
                <p><input type="submit" class="button" name="add_image" value="Upload another picture" id="upload" /></p>
              @endif
              <p><input type="submit" class="button" name="share_post" value="Share" id="share" /></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
