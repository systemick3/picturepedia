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

  /**
   * Define a one-to-many relationship.
   * Get the likes for this post.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function likes()
  {
    return $this->hasMany(Like::class);
  }

  /**
   * Format the hashtags and names in a caption.
   *
   * @return string
  */
  public function getFormattedCaptionAttribute()
  {
    preg_match_all("/(#\w+)/", $this->caption, $matches);
    $formattedCaption = strip_tags($this->caption);
    foreach ($matches[0] as $match) {
      $link = '<a href="' . route('hashtag.index', ['hashtag' => substr($match, 1)]) . '">' . $match . '</a>';
      $formattedCaption = str_replace($match, $link, $formattedCaption);
    }

    return $formattedCaption;
  }

  /**
   * Format the hashtags and names in a caption.
   *
   * @return string
  */
  public function isLikedByCurrentUser()
  {
    $currentUser = auth()->user();
    if (isset($currentUser)) {
      $likes = $currentUser->likes;
      foreach ($likes as $like) {
        if ($like->post_id == $this->id) {
          return $like->id;
        }
      }
    }
    return FALSE;
  }
}
