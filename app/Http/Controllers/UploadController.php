<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Post;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage as Storage;

class UploadController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function upload()
  {
    return view('upload.upload');
  }

  public function handleUpload(Request $request)
  {
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
      $uploadedFile = $request->file('image');
      $image = Image::make($uploadedFile);
      $image->fit(600);
      $filename = md5(time() . $uploadedFile->getClientOriginalName()) . '.' . $uploadedFile->getClientOriginalExtension();
      $image->save(public_path('storage/images/' . $filename));

      $post = new Post;
      $post->user_id = auth()->id();
      $post->caption = '';
      $post->save();

      $savedFile = new File;
      $savedFile->post_id = $post->id;
      $savedFile->filename = $uploadedFile->getClientOriginalName();
      $savedFile->filepath = 'storage/images/' . $filename;
      $savedFile->filemime = $uploadedFile->getClientOriginalExtension();
      $savedFile->filesize = $uploadedFile->getSize();
      $savedFile->status = 1;
      $savedFile->save();

      return redirect()->route('upload.crop', ['id' => $savedFile->id]);
    }
  }

  public function crop($id)
  {
    $file = File::findOrFail($id);
    $scripts = ['js/all.js'];

    return view('upload.crop')
      ->with('file', $file)
      ->with('scripts', $scripts);
  }

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

  public function share($id) {
    $file = File::findOrFail($id);
    $post = Post::findOrFail($file->post_id);
    return view('upload.share')
      ->with('post', $post)
      ->with('file', $file);
  }

  public function handleShare(Request $request) {
    $lastPost = [
      'post_id' => $request->input('post_id'),
      'file_id' => $request->input('file_id'),
      'caption' => $request->input('caption'),
      'facebook' => $request->input('facebook') === 'Facebook',
      'twitter' => $request->input('twitter') === 'Twitter',
      'messages' => ['The picture has been added to your Picturepedia feed.'],
      'errors' => [],
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

  public function complete(Request $request) {
    $lastPost = session()->get('lastPost');
    $post = Post::findOrFail($lastPost['post_id']);
    $post->caption = $lastPost['caption'] ? $lastPost['caption'] : '';
    $post->save();

    //var_dump($lastPost['messages']);
    //var_dump($lastPost['errors']);
    return 'Hello';
  }
}
