<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;

class Post extends Model
{
  protected $guarded = ['id', 'user_id', 'created_at', 'updated_at'];

  public function files() {
    return $this->hasMany(File::class);
  }
}
