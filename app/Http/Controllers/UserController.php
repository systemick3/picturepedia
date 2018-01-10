<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use App\User as User;
use App\File as File;

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
    foreach($posts as $post) {

    }
    
    return view('user.profile')
      ->with('account', $account)
      ->with('posts', $posts);
    }
}
