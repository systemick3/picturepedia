<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  /**
   * Define a many-to-one relationship.
   * Get the post for this comment.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function post()
  {
    return $this->belongsTo(Post::class);
  }

  /**
   * Define a many-to-one relationship.
   * Get the user for this comment.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
