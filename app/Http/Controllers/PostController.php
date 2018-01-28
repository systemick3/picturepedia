<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Comment Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles creation and deletion of comments.
  |
  */
  
  /**
   * Delete an existing post.
   * @param $request Illuminate\Http\Request
   * @param $id integer
   * @return redirect
   *
   */
  public function remove(Request $request, $id)
  {
    $post = Post::find($id);
    if ($post->user_id == auth()->id()) {
      $post->remove();
      $request->session()->flash('status', ['Post has been deleted']);
    }
    return redirect()->back();
  }
}
