<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Hashtag;
use App\User;

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
   * Get search results.
   *
   * @param $search string
   *
   * @return array
   */
  public function results($search)
  {
    $hashtags = Hashtag::take(5)->where('hashtag', 'like', '%' . $search . '%')
      ->orderBy('count', 'desc')
      ->get();

    $results = [];
    foreach ($hashtags as $hashtag) {
      $hashtag->link = '<a href="' . route('hashtag.index', $hashtag->hashtag) . '">' . $hashtag->formatted_name . '</a>';
      $results[] = $hashtag;
    }

    $users = User::take(5)->where('name', 'like', '%' . $search . '%')
      ->orderBy('name', 'desc')
      ->get();

    $users = $users->all();
    usort($users, [$this, 'userComp']);
    $users = array_reverse($users);
    foreach ($users as $user) {
      $user->link = '<a href="' . route('user.profile', $user->name) . '">' . $user->formatted_name . '</a>';
      $results[] = $user;
    }

    return response()->json($results);
  }

  // Sort users by follower_count.
  private function userComp($a, $b)
  {
    return strcmp($a->follower_count, $b->follower_count);
  }
}
