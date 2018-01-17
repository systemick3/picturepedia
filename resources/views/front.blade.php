@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @if (!empty($user))
        <div class="panel panel-default">
          <div class="panel-body">
            @if (!empty($avatar))
              <div><img src="{{ asset("$avatar->filepath") }}" /></div>
            @endif
            <div>{{ $user->name }}</div>
            <div>{{ $user->full_name }}</div>
          </div>
        </div>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading"></div>
          <div class="panel-body">
            @if (!empty($user))
              @if ($posts->count() < 1)
                <p>This timeline is empty.</p>
              @else
                @foreach ($posts as $post)
                  <div>
                    @foreach ($post->files as $file)
                      <transition appear name="image">
                        <img class="image" src="{{ asset("$file->filepath") }}">
                      </transition>
                      <div class="caption">{!! $post->formatted_caption !!}</div>
                    @endforeach
                  </div>
                @endforeach
              @endif
            @else
              Non logged in user content goes here.
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
