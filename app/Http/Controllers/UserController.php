<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User as User;
use App\File as File;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | User Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles displaying a user profile and editing a user
  | account.
  |
  */

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {

  }

  /**
   * Display a user profile and pictures.
   *
   * @param  string  $username
   * @return view
   */
  public function index($username)
  {
    $account = User::whereName($username)
      ->first();

    if (empty($account)) {
      abort(404);
    }

    $posts = Post::with('files')
      ->where('user_id', $account->id)
      ->orderBy('id', 'desc')
      ->get();

    $file = $account->getAvatar();
    return view('user.profile')
      ->with('account', $account)
      ->with('user', $account)
      ->with('file', $file)
      ->with('posts', $posts);
  }

  /**
   * Edit a user profile.
   *
   * @param  string  $username
   * @return view
   */
  public function edit($id)
  {
    $currentUser = auth()->user();
    $file = $currentUser->getAvatar();
    return view('user.edit')
      ->with('file', $file)
      ->with('user', $currentUser);
  }

  /**
   * Update a user profile.
   *
   * @param  Illuminate\Http\Request
   * @return redirect
   */
  public function update(Request $request, $id)
  {
    $currentUser = auth()->user();
    if ($currentUser->name !== $request->input('name')) {
      $constraints['name'] = 'required|string|max:255|unique:users';
    }
    else {
      $constraints['name'] = 'required|string|max:255';
    }
    if ($currentUser->email !== $request->input('email')) {
      $constraints['email'] = 'required|string|email|max:255|unique:users';
    }
    else {
      $constraints['email'] = 'required|string|email|max:255';
    }
    if (!empty($request->input('password'))) {
      $constraints['password'] = 'required|string|min:6|confirmed';
    }

    $this->validate($request, $constraints);

    if (!empty($request->input('name'))) {
      $currentUser->name = $request->input('name');
    }
    if (!empty($request->input('email'))) {
      $currentUser->email = $request->input('email');
    }
    if (!empty($request->input('password'))) {
      $currentUser->password = bcrypt($request->input('password'));
    }

    $currentUser->first_name = $request->input('first_name');
    $currentUser->last_name = $request->input('last_name');
    $currentUser->description = trim($request->input('description'));

    $currentUser->save();
    $request->session()->flash('status', ['Your profile was succesfully updated.']);
    return redirect()->route('user.edit', ['id' => $currentUser->id]);
  }

  /**
   * Create or replace a user's avatar.
   *
   * @param  string  $username
   * @return view
   */
  public function avatarEdit($id)
  {
    $currentUser = auth()->user();
    return view('user.avatar.edit');
  }

  /**
   * Update a user's avatar.
   *
   * @param  Illuminate\Http\Request
   * @return redirect
   */
  public function avatarUpdate(Request $request, $id)
  {
    $this->validate($request, ['image' => 'required|image']);
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
      $uploadedFile = $request->file('image');
      $image = Image::make($uploadedFile);
      $image->fit(File::FILE_SIZE_640);
      $filename = md5(time() . $uploadedFile->getClientOriginalName()) . '.' . $uploadedFile->getClientOriginalExtension();
      $image->save(public_path(File::FILE_DIR_640 . $filename));
      $savedFile = new File;
      $savedFile->filename = $filename;
      $savedFile->handleUploadedFile($uploadedFile, $image);
      $currentUser = auth()->user();

      if ($currentUser->file_id != NULL) {
        $oldAvatar = File::find($currentUser->file_id);
        $oldAvatar->remove();
      }
      $currentUser->file_id = $savedFile->id;
      $currentUser->save();
    }

    return redirect()->route('user.avatar.crop', ['id' => $currentUser->id]);
  }

  /**
   * Display user avatar to enable crop.
   *
   * @param  string $username
   * @return view
   */
  public function avatarCrop($id)
  {
    $currentUser = auth()->user();
    $scripts = ['js/crop.js'];

    return view('user.avatar.crop')
      ->with('scripts', $scripts)
      ->with('user', $currentUser)
      ->with('file', $currentUser->file);
  }

  /**
   * Crop a user's avatar.
   *
   * @param  Illuminate\Http\Request
   * @return redirect
   */
  public function handleAvatarCrop(Request $request, $id)
  {
    $currentUser = auth()->user();
    $file = File::findOrFail($currentUser->file_id);
    $image = Image::make(public_path($file->path640));
    $doCrop = $request->input('x') > 0 &&
      $request->input('y') > 0 &&
      $request->input('w') > 0 &&
      $request->input('h') > 0;

    if ($doCrop) {
      $image->crop($request->input('w'), $request->input('h'), $request->input('x'), $request->input('y'));
    }

    $image->resize(100, 100);
    $newFilename = md5($file->fullpath) . '.' . $file->filemime;
    $file->filepath = File::FILE_USER_AVATAR_DIR;
    $file->filename = $newFilename;
    $file->save();
    $image->save(public_path(File::FILE_USER_AVATAR_DIR . $newFilename));

    return redirect()->route('user.edit', ['id' => $currentUser->id]);
  }

}
