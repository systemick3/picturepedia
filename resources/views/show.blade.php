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
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
