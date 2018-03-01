<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Browser\PicturepediaTest;
use App\User;

class FrontTest extends PicturepediaTest
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    /**
     * A Dusk homepage with anonymous user.
     *
     * @return void
     */
    public function testFrontAnonymous()
    {
      $this->browse(function (Browser $browser) {
        $title = config('app.name', 'Picturepedia');
        $cookie = 'picturepedia_session';
        $posted_by = 'Posted by';
        $login_text = 'Login';
        $profile_text = 'Profile';
        $register_text = 'Register';
        $logout_text = 'Logout';
        $upload_text = 'Upload a picture';
        $post_class = '.post';
        $avatar_class = '.avatar';
        $search_form_class = '.search-form';
        $comment_form_class = '.comment-form';

        $browser->visit('/')
          ->assertRouteIs('front')
          ->assertTitle($title)
          ->assertSee($title)
          ->assertDontSee($posted_by)
          ->assertSeeLink($login_text)
          ->assertSeeLink($register_text)
          ->assertDontSeeLink($logout_text)
          ->assertDontSeeLink($profile_text)
          ->assertDontSeeLink($upload_text)
          ->assertHasCookie($cookie)
          ->assertMissing($post_class)
          ->clickLink($login_text)
          ->assertPathIs('/login')
          ->visit('/')
          ->clickLink($register_text)
          ->assertPathIs('/register');
      });
    }

    /**
     * A Dusk homepage with anonymous user.
     *
     * @return void
     */
    public function testFrontAuthenticated()
    {
      $this->browse(function (Browser $browser) {
        $title = config('app.name', 'Picturepedia');
        $cookie = 'picturepedia_session';
        $user = $this->existing_user;
        $posted_by = 'Posted by';
        $like_text = 'Like';
        $profile_text = 'Profile';
        $upload_text = 'Upload a picture';
        $logout_text = 'Logout';
        $post_class = '.post';
        $avatar_class = '.avatar';
        $search_form_class = '.search-form';
        $comment_form_class = '.comment-form';

        $browser->loginAs($user)
          ->visit('/')
          ->assertRouteIs('front')
          ->assertTitle($title)
          ->assertSee($title)
          ->assertSee($posted_by)
          ->assertSee($user->name)
          ->assertSee($user->fullname)
          ->assertSeeLink($like_text)
          ->assertSeeLink($user->name)
          ->assertHasCookie($cookie)
          ->assertVisible($post_class)
          ->assertVisible($search_form_class)
          ->assertVisible($comment_form_class)
          ->clickLink($profile_text)
          ->assertPathIs('/' . $user->name)
          ->visit('/')
          ->clickLink($upload_text)
          ->assertPathIs('/upload')
          ->visit('/')
          ->clickLink($logout_text)
          ->assertPathIs('/');
      });
    }
}
