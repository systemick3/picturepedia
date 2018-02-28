<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class FrontTest extends DuskTestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

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

            $browser->visit('/')
              ->assertRouteIs('front')
              ->assertTitle($title)
              ->assertSee($title)
              ->assertDontSee('Posted by')
              ->assertSeeLink('Login')
              ->assertSeeLink('Register')
              ->assertDontSeeLink('Logout')
              ->assertDontSeeLink('Profile')
              ->assertDontSeeLink('Upload a picture')
              ->assertHasCookie($cookie)
              ->assertMissing('.post')
              ->clickLink('Login')
              ->assertPathIs('/login')
              ->visit('/')
              ->clickLink('Register')
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
          $user = User::find(2);
          $posted_by = 'Posted by';
          $like_text = 'Like';
          $profile_text = 'Profile';
          $upload_text = 'Upload';
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
            ->assertVisible($avatar_class)
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
