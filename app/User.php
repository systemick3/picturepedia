<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

  public function followers()
  {
    return $this->belongsToMany(
      self::class,
      'follows',
      'followee_id',
      'follower_id'
    );
  }

  public function followees()
  {
    return $this->belongsToMany(
      self::class,
      'follows',
      'follower_id',
      'followee_id'
    );
  }

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
