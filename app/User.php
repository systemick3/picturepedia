<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\File;
use App\Follows;
use App\Like;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
  */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * Define a many-to-many relationship.
   * Get all users who follow this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function followers()
  {
    return $this->belongsToMany(
      self::class,
      'follows',
      'followee_id',
      'follower_id'
    );
  }

  /**
   * Define a many-to-many relationship.
   * Get all users that this user follows.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function followees()
  {
    return $this->belongsToMany(
      self::class,
      'follows',
      'follower_id',
      'followee_id'
    );
  }

  /**
   * Define a one-to-one relationship.
   * Get the avatar for this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
   */
  public function file()
  {
    return $this->belongsTo(File::class);
  }

  /**
   * Define a one-to-many relationship.
   * Get the posts for this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function posts()
  {
    return $this->hasMany(Post::class);
  }

  /**
   * Define a one-to-many relationship.
   * Get the posts for this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function likes()
  {
    return $this->hasMany(Like::class);
  }

  /**
   * Define a one-to-many relationship.
   * Get the comments for this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  /**
   * Get the user's full name.
   *
   * @return string
  */
  public function getFullNameAttribute()
  {
    $fullName = '';
    if ($this->first_name == '') {
      return $this->last_name;
    }
    else {
      if ($this->last_name == '') {
        return $this->first_name;
      }
      else {
        return $this->first_name . ' ' . $this->last_name;
      }
    }
  }

  /**
   * Return posts for a user's timeline.
   * Get all posts for all the users followed by this user.
   *
   * @return \Illuminate\Support\Collection.
   */
  public function getTimeline()
  {
    $ids = [$this->id];
    foreach ($this->followees as $followee) {
      $ids[] = $followee->id;
    }
    $posts = Post::with('files')
      ->whereIn('user_id', $ids)
      ->orderBy('id', 'desc')
      ->get();

    return $posts;
  }

  /**
   * Return number of users this user follows.
   *
   * @return int.
   */
  public function getFolloweesCount()
  {
    return count($this->followees);
  }

  /**
   * Return number of users this user follows.
   *
   * @return int.
   */
  public function getFollowersCount()
  {
    return count($this->followers);
  }

  /**
   * Return number of posts for this user.
   *
   * @return int.
   */
  public function getPostsCount()
  {
    return count($this->posts);
  }

  /**
   * Return number of users this user follows.
   *
   * @return int.
   */
  public function getAvatar()
  {
    if (!empty($this->file)) {
      return $this->file;
    }
    else {
      return File::getDefaultAvatar();
    }
  }

}
