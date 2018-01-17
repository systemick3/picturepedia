<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  /**
   * Define a many-to-one relationship.
   * Get the post for this like.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function post()
  {
    return $this->belongsTo(Post::class);
  }
}
