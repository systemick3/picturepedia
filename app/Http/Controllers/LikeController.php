<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Like Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles creation and deletion of likes.
  |
  */

  protected $fillable = ['user_id', 'post_id'];

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
   * Like a post.
   *
   */
  public function like($post_id)
  {
    $like = new Like;
    $like->user_id = auth()->id();
    $like->post_id = $post_id;
    $like->save();
    return redirect()->back();
  }

  /**
   * Unike a post.
   *
   */
  public function unlike($id)
  {
    $like = Like::find($id);
    $like->delete();
    return redirect()->back();
  }
}
