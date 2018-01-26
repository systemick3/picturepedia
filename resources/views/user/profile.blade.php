@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div><img src="{{ asset("$file->fullpath") }}" alt="{{ $account->full_name }}"/></div>
          <div>{{ $account->name }}</div>
          <div><span>Posts:</span> {{ $account->getPostsCount() }}</div>
          <div><span>Followers:</span> {{ $account->getFollowersCount() }}</div>
          <div><span>Following:</span> {{ $account->getFolloweesCount() }}</div>
          <div>{{ $account->full_name }}</div>
          <div>{{ $account->description }}</div>
          @if ($account->id == auth()->id())
            <a href="{{ route('user.edit', $account->id) }}">Edit this profile.</a>
          @endif
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading"></div>
          <div class="panel-body">
            @if ($posts->count() < 1)
              <p>This user hasn't added any images yet.</p>
            @else
              @foreach ($posts as $post)
                <div>
                  @foreach ($post->files as $file)
                    <transition appear name="image">
                      <img class="image" src="{{ asset("$file->path640") }}" alt="{{ $post->caption }}">
                    </transition>
                    <div class="caption">{!! $post->formatted_caption !!}</div>
                  @endforeach
                </div>
                @include('partials/comment/comments')
                @include('partials/comment/comment-form')
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
