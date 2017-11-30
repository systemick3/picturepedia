@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Upload an image</div>
          <div class="panel-body">
            <img id="jcrop_target" class="image" src="{{ asset("$image->filepath") }}"/>
          </div>
          <div class="panel-body">
            <div style="width:100px; height:100px; overflow:hidden; margin-top:20px;">
              <img id="preview" src="{{ asset("$image->filepath") }}" style="position:relative; width:600px; height:600px;" alt="Thumbnail Preview" />
            </div>
          </div>
          <div class="panel-body">
            <div class="js_coords">
              <form name="thumbnail" action="/upload/save" method="post">
                {{ csrf_field() }}
                <input type="hidden" name=id value="{{ $image->id }}" />
                <input type="hidden" name="x" value="" id="x" />
            	  <input type="hidden" name="y" value="" id="y" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="w" value="" id="w" />
                <input type="hidden" name="h" value="" id="h" />
                <input type="submit" class="button" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" />
                <!--<input type="submit" class="button" name="keep_image" value="Save without cropping" id="save_thumb" />-->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footerscripts')
    @parent
    @foreach ($scripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach
@endsection