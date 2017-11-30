<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $images = File::where('user_id', $account->id)->get();
        //var_dump($account);
        //print $images->count();
        //exit;
        return view('user.profile')
            ->with('account', $account)
            ->with('images', $images);
    }
}
