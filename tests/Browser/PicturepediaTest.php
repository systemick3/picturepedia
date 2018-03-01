<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Post;
use App\File;
use App\Follows;

abstract class PicturepediaTest extends DuskTestCase
{

  protected $users = [];
  protected $posts = [];
  protected $files = [];
  protected $follows = [];
  protected $existing_user;

  protected function setUp()
  {
    parent::setUp();

    $user = new User;
    $user->name = 'user_1';
    $user->email = 'user_1@example.com';
    $user->password = 'user_1';
    $user->first_name = 'User';
    $user->last_name = 'One';
    $user->description = 'Hello there, I\'m user 1';
    $user->save();
    $user_1_id = $user->id;

    $this->existing_user = $user;
    $this->users[] = $user;

    $post = new Post;
    $post->user_id = $user->id;
    $post->caption = 'Test post 1';
    $post->save();
    $this->posts[] = $post;

    $file = new File;
    $file->post_id = $post->id;
    $file->filename = '02515304fcf88437327fa0d096612416.jpg';
    $file->filepath = 'storage/images/';
    $file->filemime = 'jpg';
    $file->filesize = 119638;
    $file->status = 1;
    $file->save();
    $this->files[] = $file;

    // Default avatar
    // Post ID is set as workaround for migration bug
    $file = new File;
    $file->post_id = $post->id;
    $file->filename = 'default-avatar.png';
    $file->filepath = 'storage/images/default/';
    $file->filemime = 'png';
    $file->filesize = 3965;
    $file->status = 1;
    $file->save();
    $this->existing_user->file_id = $file->id;
    $this->existing_user->save();

    $user = new User;
    $user->name = 'user_2';
    $user->email = 'user_2@example.com';
    $user->password = 'user_2';
    $user->save();
    $this->users[] = $user;
    $user_2_id = $user->id;

    $post = new Post;
    $post->user_id = $user->id;
    $post->caption = 'Test post 2';
    $post->save();
    $this->posts[] = $post;

    $file = new File;
    $file->post_id = $post->id;
    $file->filename = '1f29360436959c42d68262003ccc73b1.jpeg';
    $file->filepath = 'storage/images/';
    $file->filemime = 'jpeg';
    $file->filesize = 86811;
    $file->status = 1;
    $file->save();
    $this->files[] = $file;

    $user = new User;
    $user->name = 'user_3';
    $user->email = 'user_3@example.com';
    $user->password = 'user_3';
    $user->save();
    $this->users[] = $user;
    $user_3_id = $user->id;

    $post = new Post;
    $post->user_id = $user->id;
    $post->caption = 'Test post 3';
    $post->save();
    $this->posts[] = $post;

    $file = new File;
    $file->post_id = $post->id;
    $file->filename = 'd9e7798cfc2bf438fb5e2725d3ac97de.jpg';
    $file->filepath = 'storage/images/';
    $file->filemime = 'jpg';
    $file->filesize = 1011011;
    $file->status = 1;
    $file->save();
    $this->files[] = $file;

    $follow = new Follows;
    $follow->follower_id = $user_1_id;
    $follow->followee_id = $user_2_id;
    $follow->save();

    $follow = new Follows;
    $follow->follower_id = $user_1_id;
    $follow->followee_id = $user_3_id;
    $follow->save();

  }
    /**
     * A Dusk test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/')
    //                 ->assertSee('Laravel');
    //     });
    // }
}
