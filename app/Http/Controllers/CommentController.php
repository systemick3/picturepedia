<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
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
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Comment on a post.
   * @param $request Illuminate\Http\Request
   * @return redirect
   *
   */
  public function store(Request $request)
  {
    $comment = new Comment;
    $comment->user_id = auth()->id();
    $comment->post_id = $request->input('post_id');
    $comment->comment = $request->input('comment');
    $comment->save();
    $request->session()->flash('status', ['Your comment was succesfully added.']);
    return redirect()->back();
  }

  /**
   * Delete an existing comment.
   * @param $request Illuminate\Http\Request
   * @param $id integer
   * @return redirect
   *
   */
  public function remove(Request $request, $id)
  {
    $comment = Comment::find($id);
    if ($comment->user_id == auth()->id()) {
      $comment->delete();
      $request->session()->flash('status', ['Comment has been deleted']);
    }
    return redirect()->back();
  }
}
