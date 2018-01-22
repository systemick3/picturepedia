<div class="comment-form">
  <form class="form-horizontal" method="POST" action="{{ route('comment.store') }}">
    {{ csrf_field() }}
    <input type="hidden" name=post_id value="{{ $post->id }}" />
    <counted-textarea
      :max-characters="250"
      rows="4"
      cols="50"
      placeholder="Add a comment"
      name="comment"
      v-model="commentText">
    </counted-textarea>
    <p><input type="submit" class="button" name="add_comment" value="Add comment" id="comment-create" /></p>
</div>
