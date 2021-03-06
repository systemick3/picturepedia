<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Tests\Browser\PicturepediaTest;
use App\User;
use App\File;

class UploadTest extends PicturepediaTest
{
  use DatabaseMigrations;
  use WithoutMiddleware;

    /**
     * Test upload form unavailable to anonymous users.
     *
     * @return void
     */
    public function testUploadAnonymous()
    {
      $this->browse(function (Browser $browser) {
        $login_text = 'Login';
        $remember_text = 'Remember Me';
        $password_text = 'Forgot Your Password';

        $browser->visit('/upload')
          ->assertSee($login_text)
          ->assertSee($remember_text)
          ->assertSee($password_text);
      });
    }

    /**
     * Test upload workflow.
     *
     * @return void
     */
    public function testUploadForm()
    {
      $this->browse(function (Browser $browser) {
        $user = $this->users['user_1'];
        $upload_text = 'Upload a picture';
        $see_text_1 = 'You have uploaded 1 file';
        $see_text_2 = 'You have uploaded 2 files';
        $see_text_3 = 'You have uploaded 3 files';
        $see_text_4 = 'You have uploaded 4 files';
        $share_text = 'Share your picture';
        $caption_text = 'Testing caption';
        $more_caption_text = $caption_text . ' and testing caption again.';
        $btn_class = '.btn-primary';
        $preview_id = '#preview';
        $save_id = '#save_thumb';
        $upload_id = '#upload';
        $facebook_id = '#facebook';
        $twitter_id = '#twitter';
        $share_id = '#share';
        $result = DB::select('select max(id) as max_file_id from files');
        $max_file_id = $result[0]->max_file_id;
        $max_file_id++;
        $result = DB::select('select max(id) as max_post_id from posts');
        $max_post_id = $result[0]->max_post_id;
        $max_post_id++;
        $crop_script = 'js/crop.js';
        $facebook_field = '<input id="facebook" type="checkbox" name="facebook" value="Facebook" />';
        $upload_another_button = '<input type="submit" name="add_image" value="Upload another picture" id="upload" class="button" />';
        $success_text = 'The pictures have been added to your Picturepedia feed';

        $browser->loginAs($user)
          ->visitRoute('upload.upload', ['id' => $user->id])
          ->assertSee($upload_text)
          ->assertSourceHas('<input type="file" name="image" />')
          ->attach('image', __DIR__.'/images/banner_large.jpg')
          ->click($btn_class)
          ->assertRouteIs('upload.crop', ['id' => $max_file_id])
          ->assertSourceHas('<script src="' . asset($crop_script) . '"></script>')
          ->assertVisible($preview_id)
          ->assertVisible($save_id)
          ->click($save_id)
          ->assertRouteIs('upload.share', $max_file_id)
          ->assertSee($see_text_1)
          ->assertSee($share_text)
          ->assertSourceHas('<form name="share" action="/upload/share" method="post">')
          ->assertSourceHas('<input type="hidden" name="file_id" value="' . $max_file_id . '" />')
          ->assertSourceHas('<input type="hidden" name="post_id" value="' . $max_post_id . '" />')
          ->assertSourceHas('<textarea rows="4" cols="50" name="caption" placeholder="Add a caption"></textarea>')
          ->assertSourceHas($facebook_field)
          ->assertSourceHas('<input id="twitter" type="checkbox" name="twitter" value="Twitter" />')
          ->assertSourceHas($upload_another_button)
          ->assertSourceHas('<input type="submit" name="share_post" value="Share" id="share" class="button" />')
          ->type('caption', $caption_text)
          ->check('facebook')
          ->check('twitter')
          ->click($upload_id)
          ->assertRouteIs('upload.upload')
          ->attach('image', __DIR__.'/images/banner_large.jpg')
          ->click($btn_class)
          ->assertRouteIs('upload.crop', ['id' => ++$max_file_id])
          ->click($save_id)
          ->assertRouteIs('upload.share', $max_file_id)
          ->assertSee($see_text_2)
          ->assertInputValue('caption', $caption_text)
          ->assertChecked('facebook')
          ->assertChecked('twitter')
          ->click($upload_id)
          ->assertRouteIs('upload.upload')
          ->attach('image', __DIR__.'/images/banner_large.jpg')
          ->click($btn_class)
          ->assertRouteIs('upload.crop', ['id' => ++$max_file_id])
          ->click($save_id)
          ->assertRouteIs('upload.share', $max_file_id)
          ->assertSee($see_text_3)
          ->assertInputValue('caption', $caption_text)
          ->click($upload_id)
          ->assertRouteIs('upload.upload')
          ->attach('image', __DIR__.'/images/banner_large.jpg')
          ->click($btn_class)
          ->assertRouteIs('upload.crop', ['id' => ++$max_file_id])
          ->click($save_id)
          ->assertRouteIs('upload.share', $max_file_id)
          ->assertSee($see_text_4)
          ->assertInputValue('caption', $caption_text)
          ->type('caption', $more_caption_text)
          ->assertSourceMissing($upload_another_button)
          ->uncheck('facebook')
          ->uncheck('twitter')
          ->assertNotChecked($facebook_id)
          ->assertNotChecked($twitter_id)
          ->click($share_id)
          ->assertRouteIs('front')
          //->assertSee($success_text)
          ->assertSee($more_caption_text);
      });
    }
}
