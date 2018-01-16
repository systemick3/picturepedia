<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HashtagController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Hashtag Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles display of user's hashtag pages.
  |
  */

  /**
   * Display posts tagged with a given tag.
   *
   * @return view
   */
  public function index($hashtag)
  {
    $posts = Post::where('caption', 'LIKE', "%#$hashtag%")->get();
    return view('hashtag.index')
      ->with('hashtag', '#' . $hashtag)
      ->with('posts', $posts);
  }
}
