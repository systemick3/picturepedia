<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\File;

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
   * Return posts for a user's timeline.
   * Get all posts for all the users followed by this user.
   *
   * @return \Illuminate\Support\Collection.
   */
  public function getTimeline()
  {
    $ids = [];
    foreach ($this->followees as $followee) {
      $ids[] = $followee->id;
    }
    $posts = Post::with('files')
      ->whereIn('user_id', $ids)
      ->orderBy('id', 'desc')
      ->get();

    return $posts;
  }

}
