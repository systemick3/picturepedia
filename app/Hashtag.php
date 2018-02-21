<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
  */
  protected $fillable = [
    'hashtag',
  ];

  /**
   * Get the hashtag's formatted username.
   *
   * @return string
  */
  public function getFormattedNameAttribute()
  {
    return '#' . $this->hashtag;
  }
}
