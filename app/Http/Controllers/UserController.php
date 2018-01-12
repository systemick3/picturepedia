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
  public function __construct(){
    //$this->middleware('auth');
  }

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

    return view('user.profile')
      ->with('account', $account)
      ->with('posts', $posts);
  }

  public function edit($username) {
    $currentUser = auth()->user();

    if (empty($currentUser)) {
      abort(404);
    }

    if ($currentUser->name !== $username) {
      return new Response('Forbidden', 403);
    }

    return view('user.edit')
      ->with('user', $currentUser);
  }

  public function update(Request $request)
  {
    $currentUser = auth()->user();
    if (empty($currentUser)) {
      abort(404);
    }

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

    $currentUser->save();

    $request->session()->flash('status', 'Update was successful!');

    return redirect()->route('user.edit', ['username' => $currentUser->name]);
  }

}
