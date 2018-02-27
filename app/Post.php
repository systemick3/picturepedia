<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;
use App\Hashtag;

class Post extends Model
{
  protected $guarded = ['id', 'user_id', 'created_at', 'updated_at'];

  const POST_MAX_FILES = 4; // Twitter allows up to 4 pics in 1 post.

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
   * Define a many-to-one relationship.
   * Get the user for this post.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function user()
  {
    return $this->belongsTo(User::class);
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
   * Define a one-to-many relationship.
   * Get the comments for this post.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function comments()
  {
    return $this->hasMany(Comment::class);
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
   * Delete this post and it's related files.
   *
   * @return void
  */
  public function remove()
  {
    foreach ($this->files as $file) {
      $file->remove();
    }
    $this->delete();
  }

  /**
   * Get the amount of time since this post was created.
   *
   * @return string
  */
  public function getFormattedCreatedAttribute  ()
  {
    $date1 = new \DateTime($this->created_at);
    $date2 = new \DateTime();
    $diff = $date2->diff($date1);

    if ($diff->y > 0) {
      return $diff->y . ' ' . str_plural('year', $diff->y) . ' ago.';
    }
    if ($diff->m > 0) {
      return $diff->m . ' ' . str_plural('month', $diff->m) .  ' ago.';
    }
    if ($diff->d > 0) {
      return $diff->d . ' ' . str_plural('day', $diff->d) .  ' ago.';
    }
    if ($diff->h > 0) {
      return $diff->h . ' ' . str_plural('hour', $diff->h) .  ' ago.';
    }
    if ($diff->i > 0) {
      return $diff->i . ' ' . str_plural('minute', $diff->i) .  ' ago.';
    }
    if ($diff->s > 0) {
      return $diff->s . ' ' . str_plural('second', $diff->s) .  ' ago.';
    }
  }

  /**
   * Determine if a post has been liked by a user.
   *
   * @return integer/boolean
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

  /**
   * Create/update any hashtags in this post.
   *
   * @return void
  */
  public function createHashtags() {
    preg_match_all("/(#\w+)/", $this->caption, $matches);

    foreach ($matches[0] as $match) {
      $text = substr($match, 1);
      $hashtag = Hashtag::where('hashtag', $text)->first();

      if (!empty($hashtag)) {
        $hashtag->count++;
      }
      else {
        $hashtag = new Hashtag;
        $hashtag->hashtag = $text;
        $hashtag->count = 1;
      }

      $hashtag->save();
    }
  }
}
