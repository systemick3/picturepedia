<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  public function remove(Request $request, $id)
  {
    $post = Post::find($id);
    $post->remove();
    $request->session()->flash('status', ['Post has been deleted']);
    return redirect()->back();
  }
}
