<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class File extends Model
{
    protected $guarded = ['id', 'post_id', 'created_at', 'updated_at'];

    public function post() {
      return $this->belongsTo(Post::class);
    }
}
