@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div><img src="{{ asset("$file->filepath") }}" /></div>
          <div>{{ $account->name }}</div>
          <div><span>Posts:</span> {{ $account->getPostsCount() }}</div>
          <div><span>Followers:</span> {{ $account->getFollowersCount() }}</div>
          <div><span>Following:</span> {{ $account->getFolloweesCount() }}</div>
          <div>{{ $account->full_name }}</div>
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
                      <img class="image" src="{{ asset("$file->filepath") }}">
                    </transition>
                    <div class="caption">{{ $post->caption }}</div>
                  @endforeach
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
