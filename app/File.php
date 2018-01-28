<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Post;

class File extends Model
{
  protected $guarded = ['id', 'post_id', 'created_at', 'updated_at'];

  const FILE_STORAGE_DIR = 'storage/images/';
  const FILE_DIR_150 = File::FILE_STORAGE_DIR . '150x150w/';
  const FILE_DIR_240 = File::FILE_STORAGE_DIR . '240x240w/';
  const FILE_DIR_320 = File::FILE_STORAGE_DIR . '320x320w/';
  const FILE_DIR_480 = File::FILE_STORAGE_DIR . '480x480w/';
  const FILE_DIR_640 = File::FILE_STORAGE_DIR . '640x640w/';
  const FILE_SIZE_150 = 150;
  const FILE_SIZE_240 = 240;
  const FILE_SIZE_320 = 320;
  const FILE_SIZE_480 = 480;
  const FILE_SIZE_640 = 640;
  const FILE_SIZE_1080 = 1080;
  const FILE_DEFAULT_AVATAR_DIR = 'storage/images/default/';
  const FILE_DEFAULT_AVATAR_NAME = 'default-avatar.png';
  const FILE_USER_AVATAR_DIR = File::FILE_STORAGE_DIR . 'profile/';

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
    $this->filepath = File::FILE_STORAGE_DIR;
    $this->filemime = $uploadedFile->getClientOriginalExtension();
    $this->filesize = $uploadedFile->getSize();
    $this->status = 1;
    $this->save();
  }

  /**
   * Delete this file in the database and on the file system.
   *
   * @return boolean|void
  */
  public function remove()
  {
    if (is_file(public_path() . '/' . $this->fullpath)) {
      unlink(public_path() . '/' . $this->fullpath);
    }
    if (is_file(public_path() . '/' . $this->path640)) {
      unlink(public_path() . '/' . $this->path640);
    }
    if (is_file(public_path() . '/' . $this->path480)) {
      unlink(public_path() . '/' . $this->path480);
    }
    if (is_file(public_path() . '/' . $this->path320)) {
      unlink(public_path() . '/' . $this->path320);
    }
    if (is_file(public_path() . '/' . $this->path240)) {
      unlink(public_path() . '/' . $this->path240);
    }
    if (is_file(public_path() . '/' . $this->path150)) {
      unlink(public_path() . '/' . $this->path150);
    }
    if (is_file(public_path() . '/' . $this->path150)) {
      unlink(public_path() . '/' . $this->pathAvatar);
    }
    return $this->delete();
  }

  /**
   * Get the file's full path.
   *
   * @return string
  */
  public function getFullPathAttribute()
  {
    return $this->filepath . $this->filename;
  }

  /**
   * Get the file's 640 path by filesize.
   *
   * @return string
  */
  public function getPath640Attribute()
  {
    return File::FILE_DIR_640 . $this->filename;
  }

  /**
   * Get the file's 480 path by filesize.
   *
   * @return string
  */
  public function getPath480Attribute()
  {
    return File::FILE_DIR_480 . $this->filename;
  }

  /**
   * Get the file's 320 path by filesize.
   *
   * @return string
  */
  public function getPath320Attribute()
  {
    return File::FILE_DIR_320 . $this->filename;
  }

  /**
   * Get the file's 240 path by filesize.
   *
   * @return string
  */
  public function getPath240Attribute()
  {
    return File::FILE_DIR_240 . $this->filename;
  }

  /**
   * Get the file's 150 path by filesize.
   *
   * @return string
  */
  public function getPath150Attribute()
  {
    return File::FILE_DIR_150 . $this->filename;
  }

  /**
   * Get the file's avatar path.
   *
   * @return string
  */
  public function getPathAvatarAttribute()
  {
    return File::FILE_USER_AVATAR_DIR . $this->filename;
  }

  /**
   * Get the default user avatar.
   *
   * @return \App\File
  */
  public static function getDefaultAvatar()
  {
    return File::where(
      [
        'filename' => File::FILE_DEFAULT_AVATAR_NAME,
        'filepath' => File::FILE_DEFAULT_AVATAR_DIR,
      ]
    )->first();
  }
}
