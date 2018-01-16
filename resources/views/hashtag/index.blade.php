@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading"></div>
          <p>{{ $hashtag }}</p>
          <p>{{ $posts->count() }} {{ str_plural('post', $posts->count()) }}</p>
          <div class="panel-body">
            @if ($posts->count() < 1)
              <p>No results found for {{ $hashtag }}.</p>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
