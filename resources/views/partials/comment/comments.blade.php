<div class="comments">
  @foreach ($post->comments as $comment)
    <div class="comment">
      <div class="text">
        {{ $comment->comment }}
      </div>
      <div class="user">
        {{ $comment->user->name }}
      </div>
    </div>
  @endforeach
</div>
