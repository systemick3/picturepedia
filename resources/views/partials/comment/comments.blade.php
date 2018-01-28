<div class="comments">
  @foreach ($post->comments as $comment)
    <div class="comment">
      <div class="text">
        {{ $comment->comment }}
      </div>
      <div class="user">
        {{ $comment->user->name }}
      </div>
      @if ($comment->user_id == $user->id)
        <div class="remove">
          <a href="{{ route('comment.remove', $comment->id) }}">Remove</a>
        </div>
      @endif
    </div>
  @endforeach
</div>
