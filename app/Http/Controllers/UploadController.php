<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
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
      $savedFile = new File;
      $savedFile->user_id = auth()->id();
      $savedFile->filename = $uploadedFile->getClientOriginalName();
      $savedFile->filepath = 'storage/images/' . $filename;
      $savedFile->filemime = $uploadedFile->getClientOriginalExtension();
      $savedFile->filesize = $uploadedFile->getSize();
      $savedFile->status = 1;
      $savedFile->save();

      return redirect()->route('upload-crop', ['id' => $savedFile->id]);
    }
  }

  public function crop($id)
  {
    $file = File::findOrFail($id);
    $scripts = ['js/all.js'];

    return view('upload.crop')
      ->with('image', $file)
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

    // var_dump($request->all());
    // die(__FILE__.__LINE__);

    if ($doCrop) {
      $image->crop($request->input('w'), $request->input('h'), $request->input('x'), $request->input('y'))
        ->resize(600, 600);
    }

    $newFilename = md5($file->filepath) . '.' . $file->filemime;
    $file->filepath = 'storage/images/' . $newFilename;
    $file->save();
    $image->save(public_path('storage/images/' . $newFilename));
    return redirect()->route('upload-share', ['id' => $file->id]);
  }

  public function share($id) {
    $file = File::findOrFail($id);
    return view('upload.share')
        ->with('image', $file);
  }

  public function handleShare(Request $request) {
    return 'Hello World';
  }
}
