<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Post;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage as Storage;
use Illuminate\Support\Messagebag;

class UploadController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Upload Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles user uploads.
  |
  */

  const UPLOAD_MAX_SIZE = 2046;
  const UPLOAD_MIN_SIZE = 600;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display the upload form.
   *
   */
  public function upload()
  {
    var_dump(session()->get('lastPost'));
    return view('upload.upload');
  }

  /**
   * Handle the form upload.
   *
   * @param  Illuminate\Http\Request  $request
   * @return redirect
   */
  public function handleUpload(Request $request)
  {
    $this->validate($request, ['image' => 'required|image']);
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
      $uploadedFile = $request->file('image');
      $image = Image::make($uploadedFile);

      if ($image->width() > UploadController::UPLOAD_MAX_SIZE || $image->height() > UploadController::UPLOAD_MAX_SIZE) {
        $messages = ['errors' => ['Maximum height and width (' . UploadController::UPLOAD_MAX_SIZE . ' pixels) exceeded. Please upload a smaller image.']];
        $messageBag = new MessageBag($messages);
        return redirect()->back()->withErrors($messageBag);
      }

      if ($image->width() < UploadController::UPLOAD_MIN_SIZE || $image->height() < UploadController::UPLOAD_MIN_SIZE) {
        $messages = ['warnings' => ['For the best results please upload an image with width and height no less than ' . UploadController::UPLOAD_MIN_SIZE . ' pixels.']];
        $messageBag = new MessageBag($messages);
        return redirect()->back()->withErrors($messageBag);
      }

      $filename = md5(time() . $uploadedFile->getClientOriginalName()) . '.' . $uploadedFile->getClientOriginalExtension();
      $image->fit(File::FILE_SIZE_1080);
      $image->save(public_path(File::FILE_STORAGE_DIR . $filename));
      $image->resize(File::FILE_SIZE_640, File::FILE_SIZE_640);
      $image->save(public_path(File::FILE_DIR_640 . $filename));
      $savedFile = new File;
      $savedFile->filename = $filename;
      $savedFile->handleUploadedFile($uploadedFile, $image);
      return redirect()->route('upload.crop', ['id' => $savedFile->id]);
    }
    else {
      abort(404);
    }
  }

  /**
   * Display uploaded image to enable a crop.
   *
   * @param  integer  $id
   * @return view
   */
  public function crop($id)
  {
    $file = File::findOrFail($id);
    $scripts = ['js/crop.js'];
    return view('upload.crop')
      ->with('file', $file)
      ->with('scripts', $scripts);
  }

  /**
   * Handle the form posted when a crop is done.
   *
   * @param  Illuminate\Http\Request  $request
   * @return redirect
   */
  public function handleCrop(Request $request)
  {
    $file = File::findOrFail($request->input('id'));
    $image = Image::make(public_path($file->fullpath));
    $doCrop = $request->input('x') > 0 &&
      $request->input('y') > 0 &&
      $request->input('w') > 0 &&
      $request->input('h') > 0;

    if ($doCrop) {
      $image->crop($request->input('w'), $request->input('h'), $request->input('x'), $request->input('y'))
        ->resize(File::FILE_SIZE_1080, File::FILE_SIZE_1080);
    }

    $image->save(public_path(File::FILE_DIR_1080 . $file->filename));
    $image->resize(File::FILE_SIZE_480, File::FILE_SIZE_480);
    $image->save(public_path(File::FILE_DIR_480 . $file->filename));
    $image->resize(File::FILE_SIZE_320, File::FILE_SIZE_320);
    $image->save(public_path(File::FILE_DIR_320 . $file->filename));
    $image->resize(File::FILE_SIZE_240, File::FILE_SIZE_240);
    $image->save(public_path(File::FILE_DIR_240 . $file->filename));
    $image->resize(File::FILE_SIZE_150, File::FILE_SIZE_150);
    $image->save(public_path(File::FILE_DIR_150 . $file->filename));
    return redirect()->route('upload.share', ['id' => $file->id]);
  }

  /**
   * Display form to enable a post to be shared.
   *
   * @param  integer  $id
   * @return view
   */
  public function share($id)
  {
    $lastPost = session()->get('lastPost');
    if (empty($lastPost)) {
      $lastPost = ['file_ids' => [$id]];
    }
    else {
      if (!in_array($id, $lastPost['file_ids'])) {
        $lastPost['file_ids'][] = $id;
      }
    }

    $file = File::findOrFail($id);

    if (isset($lastPost['post_id'])) {
      $post = Post::findOrFail($lastPost['post_id']);
    }
    else {
      $post = new Post;
      $post->user_id = auth()->id();
      $post->caption = '';
      $post->save();
      $lastPost['post_id'] = $post->id;
    }

    session()->put('lastPost', $lastPost);
    $file->post_id = $post->id;
    $file->save();

    $file_count = count($lastPost['file_ids']);
    $add_more = $file_count < Post::POST_MAX_FILES;
    return view('upload.share')
      ->with('post', $post)
      ->with('file_count', $file_count)
      ->with('add_more', $add_more)
      ->with('file', $file);
  }

  /**
   * Handle the form posted when post is shared.
   *
   * @param  Illuminate\Http\Request  $request
   * @return redirect
   */
  public function handleShare(Request $request)
  {
    $params = [
      'post_id' => $request->input('post_id'),
      'caption' => $request->input('caption'),
      'facebook' => $request->input('facebook') === 'Facebook',
      'twitter' => $request->input('twitter') === 'Twitter',
      'status' => [],
      'error' => [],
    ];

    $lastPost = array_merge(session()->get('lastPost'), $params);

    session()->put('lastPost', $lastPost);
    if ($request->input('facebook') === 'Facebook') {
      return redirect()->route('facebook.index');
    }
    else if ($request->input('twitter') === 'Twitter') {
      return redirect()->route('twitter.index');
    }
    else {
      return redirect()->route('upload.complete');
    }
  }

  /**
   * Handle the form posted when a post is completed.
   *
   * @param  Illuminate\Http\Request  $request
   * @return redirect
   */
  public function complete(Request $request)
  {
    $lastPost = session()->get('lastPost');
    $post = Post::findOrFail($lastPost['post_id']);
    $post->caption = $lastPost['caption'] ? $lastPost['caption'] : '';
    $post->save();
    session()->push('lastPost.status', 'The picture has been added to your Picturepedia feed.');
    $status = $request->session()->get('lastPost.status');
    $error = $request->session()->get('lastPost.error');
    $request->session()->flash('status', $status);
    $request->session()->flash('error', $error);
    $request->session()->forget('lastPost');
    return redirect()->route('front');
  }
}
