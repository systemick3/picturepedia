<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Post;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage as Storage;

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
    $this->validate($request, ['image' => 'required']);
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
      $uploadedFile = $request->file('image');
      $post = new Post;
      $post->user_id = auth()->id();
      $post->caption = '';
      $post->save();
      $savedFile = new File;
      $savedFile->post_id = $post->id;
      $savedFile->handleUploadedFile($uploadedFile);
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
    $image = Image::make(public_path($file->filepath));
    $doCrop = $request->input('x') > 0 &&
      $request->input('y') > 0 &&
      $request->input('w') > 0 &&
      $request->input('h') > 0;

    if ($doCrop) {
      $image->crop($request->input('w'), $request->input('h'), $request->input('x'), $request->input('y'))
        ->resize(600, 600);
    }

    $newFilename = md5($file->filepath) . '.' . $file->filemime;
    $file->filepath = 'storage/images/' . $newFilename;
    $file->save();
    $image->save(public_path('storage/images/' . $newFilename));
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
    $file = File::findOrFail($id);
    $post = Post::findOrFail($file->post_id);
    return view('upload.share')
      ->with('post', $post)
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
    $lastPost = [
      'post_id' => $request->input('post_id'),
      'file_id' => $request->input('file_id'),
      'caption' => $request->input('caption'),
      'facebook' => $request->input('facebook') === 'Facebook',
      'twitter' => $request->input('twitter') === 'Twitter',
      'status' => [],
      'error' => [],
    ];

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
