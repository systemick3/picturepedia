<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Post;

class File extends Model
{
    protected $guarded = ['id', 'post_id', 'created_at', 'updated_at'];

    public function post() {
      return $this->belongsTo(Post::class);
    }

    public function handleUploadedFile($uploadedFile) {
      $image = Image::make($uploadedFile);
      $image->fit(600);
      $filename = md5(time() . $uploadedFile->getClientOriginalName()) . '.' . $uploadedFile->getClientOriginalExtension();
      $image->save(public_path('storage/images/' . $filename));

      $this->filename = $uploadedFile->getClientOriginalName();
      $this->filepath = 'storage/images/' . $filename;
      $this->filemime = $uploadedFile->getClientOriginalExtension();
      $this->filesize = $uploadedFile->getSize();
      $this->status = 1;
      $this->save();
    }
}
