<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Post;

class File extends Model
{
  protected $guarded = ['id', 'post_id', 'created_at', 'updated_at'];

  const FILE_DEFAULT_AVATAR = 'storage/images/default/default-avatar.png';

  /**
   * Define a one-to-one relationship.
   * Get the avatar for this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function post()
  {
    return $this->belongsTo(Post::class);
  }

  /**
   * Display a user profile and pictures.
   *
   * @param  \Illuminate\Http\UploadedFile $uploadedFile
   * @return void
  */
  public function handleUploadedFile($uploadedFile, $image)
  {
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

  /**
   * Get the default user avatar.
   *
   * @return \App\File
  */
  public static function getDefaultAvatar()
  {
    return File::whereFilepath(File::FILE_DEFAULT_AVATAR)->first();
  }
}
