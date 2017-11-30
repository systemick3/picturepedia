@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Upload an image</div>
          <div class="panel-body">
            <form method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="file" name="image" />
              <input type="submit" />
            </form>    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
