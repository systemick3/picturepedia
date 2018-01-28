<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class SearchController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Search Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles search functionality
  |
  */

  /**
   * Handle form post.
   *
   * @param  Illuminate\Http\Request
   * @return redirect()
   */
  public function search(Request $request)
  {
    return redirect()->route('search.results', ['term' => ltrim($request->input('search_term'), '#')]);
  }

  /**
   * Create or replace a user's avatar.
   *
   * @return view()
   */
  public function results($term)
  {
    //$terrm = ltrim($term, '')
    $posts = Post::with('files')
      ->where('caption', 'like', '%#' . $term . '%')
      ->orderBy('created_at', 'desc')
      ->get();

    //$users

    // foreach ($posts as $post) {
    //   var_dump($post);
    // }

    return "Hello $term" . $term[0];
  }
}
