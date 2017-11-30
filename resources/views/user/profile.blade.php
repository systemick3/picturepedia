@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading"></div>
          <div class="panel-body">
            <p>Profile for {{ $account->name }}.</p>
            @if ($images->count() < 1)
                <p>This user hasn't added any images yet.</p>
            @else
                @foreach ($images as $image)
                    <div>
                        <transition appear name="image">
                            <img class="image" src="{{ asset("$image->filepath") }}">
                        </transition>
                    </div>
                @endforeach
            @endif
            User content goes here.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
