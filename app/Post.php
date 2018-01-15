<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;

class Post extends Model
{
  protected $guarded = ['id', 'user_id', 'created_at', 'updated_at'];

  /**
   * Define a one-to-many relationship.
   * Get the files for this post.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function files()
  {
    return $this->hasMany(File::class);
  }
}
