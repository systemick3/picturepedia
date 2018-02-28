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
            $title = config('app.name', 'Laravel');
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
          $title = config('app.name', 'Laravel');
          $cookie = 'picturepedia_session';
          $user = User::find(2);

          $browser->loginAs($user)
            ->visit('/')
            ->assertRouteIs('front')
            ->assertTitle($title)
            ->assertSee($title)
            ->assertSee('Posted by')
            ->assertSee($user->name)
            ->assertSee($user->fullname)
            ->assertSeeLink('Like')
            ->assertSeeLink($user->name)
            ->assertHasCookie($cookie)
            ->assertVisible('.post')
            ->assertVisible('.avatar')
            ->assertVisible('.search-form')
            ->assertVisible('.comment-form')
            ->clickLink('Profile')
            ->assertPathIs('/' . $user->name)
            ->visit('/')
            ->clickLink('Logout')
            ->assertPathIs('/');
      });
    }
}
