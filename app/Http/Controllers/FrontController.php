<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FrontController extends Controller
{
  public function __construct(){
    //$this->middleware('auth');
  }

  public function index()
  {
    $currentUser = auth()->user();
    if (!empty($currentUser)) {
      return view('front')
        ->with('posts', $currentUser->getTimeline())
        ->with('user', $currentUser);
    }
    else {
      return view('front');
    }
  }
}
