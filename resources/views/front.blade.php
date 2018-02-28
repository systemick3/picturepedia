@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @if (!empty($user))
        <div class="panel panel-default">
          <div class="panel-body">
            @if (!empty($avatar))
              <div class="avatar"><img src="{{ asset("$avatar->fullpath") }}" alt="{{ $user->full_name }}"/></div>
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
                  <div class="post">
                    <div class="user">
                      <p>Posted by {{ $post->user->name }}</p>
                      <p>{{ $post->formattedCreated }}</p>
                    </div>
                    <div class="post-images">
                      @foreach ($post->files as $key => $file)
                        @if (count($post->files) > 1 && $key === 0)
                          <a class="direction direction-prev hidden"><i class="fas fa-caret-square-left fa-5x"></i></a>
                          <a class="direction direction-next"><i class="fas fa-caret-square-right fa-5x"></i></a>
                        @endif
                        <div class="post-image {{ $key > 0 ? 'hidden' : '' }}">
                          <transition appear name="image">
                            <img
                              class="image"
                              sizes="640px"
                              srcset="
                                {{ asset($file->fullpath) }} 1080w,
                                {{ asset($file->path640) }} 640w,
                                {{ asset($file->path480) }} 480w"
                              src="{{ asset($file->path640) }}"
                              alt="{{ $post->caption }}">
                          </transition>
                        </div>
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
                    @if ($post->user_id == $user->id)
                      <div class="remove">
                        <a href="{{ route('post.remove', $post->id) }}">Remove</a>
                      </div>
                    @endif
                    @include('partials/comment/comments')
                    @include('partials/comment/comment-form')
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

@section('footerscripts')
    @parent
    @foreach ($scripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach
@endsection
