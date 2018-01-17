<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FrontController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Front Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles display of user's timeline on homepage.
  |
  */

  public function __construct(){

  }

  /**
   * Display a user's timeline.
   *
   * @return view
   */
  public function index()
  {
    $currentUser = auth()->user();
    if (!empty($currentUser)) {
      $avatar = $currentUser->getAvatar();
      return view('front')
        ->with('posts', $currentUser->getTimeline())
        ->with('avatar', $avatar)
        ->with('user', $currentUser);
    }
    else {
      return view('front');
    }
  }
}
