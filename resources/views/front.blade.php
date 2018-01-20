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
                  <div class="user">
                    Posted by {{ $post->user->name }}
                  </div>
                  <div>
                    @foreach ($post->files as $file)
                      <transition appear name="image">
                        <img class="image" src="{{ asset("$file->filepath") }}">
                      </transition>
                    @endforeach
                  </div>
                  <div class="caption">{!! $post->formatted_caption !!}</div>
                  <div class="like">
                    @if ($post->isLikedByCurrentUser())
                      <a href="{{ route('like.unlike', $post->isLikedByCurrentUser()) }}">Unlike</a>
                    @else
                      <a href="{{ route('like.like', $post->id) }}">Like</a>
                    @endif
                  </div>
                  @include('partials/comment/comments')
                  @include('partials/comment/comment-form')
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
