<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Browser\PicturepediaTest;
use App\User;

class UserTest extends PicturepediaTest
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    protected function setUp()
    {
      parent::setUp();
    }

    /**
     * Check contents of login page.
     *
     * @return void
     */
    public function testLoginPage()
    {
      $this->browse(function (Browser $browser) {
        $title = config('app.name', 'Picturepedia');
        $login_text = 'Login';
        $email_text = 'E-Mail Address';
        $password_text = 'Password';
        $remember_text = 'Remember Me';
        $forgot_text = 'Forgot Your Password?';

        $browser->visit('/login')
          ->assertSee(config('app.name', 'Picturepedia'))
          ->assertRouteIs('login')
          ->assertTitle($title)
          ->assertSee($title)
          ->assertSee($login_text)
          ->assertSee($email_text)
          ->assertSee($password_text)
          ->assertSee($remember_text)
          ->assertSeeLink($forgot_text)
          ->clickLink($forgot_text)
          ->assertPathIs('/password/reset');
        });
    }

    /**
     * Check submission of login form.
     *
     * @return void
     */
    public function testLoginFormSubmit()
    {
      $this->browse(function (Browser $browser) {
        $title = config('app.name', 'Picturepedia');
        $logout_text = 'Logout';
        $email_text = 'E-Mail Address';
        $password_text = 'Password';
        $remember_text = 'Remember Me';
        $forgot_text = 'Forgot Your Password?';
        $btn_class = '.btn-primary';
        $bad_password = 'bad_password';
        $credentials_text = 'These credentials do not match our record';

        //die('password = ' . $this->existing_user->password);

        $browser->visit('/login')
          ->assertSee(config('app.name', 'Picturepedia'))
          ->assertRouteIs('login')
          ->assertTitle($title)
          ->type('email', $this->existing_user->email)
          ->type('password', $bad_password)
          ->click($btn_class)
          ->assertPathIs('/login')
          ->assertSee($credentials_text);
          // ->type('password', $this->existing_user->password)
          // ->click($btn_class)
          // ->assertPathIs('/login')
          //->clickLink($logout_text)
          //->assertPathIs('/');
      });
    }

    /**
     * Check submission of login form.
     *
     * @return void
     */
    public function testRegistraionForm()
    {
      $this->browse(function (Browser $browser) {
        $title = config('app.name', 'Picturepedia');
        $register_text = 'Register';
        $name_text = 'Name';
        $email_text = 'E-Mail Address';
        $password_text = 'Password';
        $password2_text = 'Confirm Password';
        $test_user = new \stdClass;
        $test_user->name = 'test_3';
        $test_user->email = str_random(15) . '@example.com';
        $test_user->password = 'test_3';
        $btn_class = '.btn-primary';
        $existing_email_text = 'The email has already been taken';

        $browser->visit('/register')
          ->assertSee(config('app.name', 'Picturepedia'))
          ->assertRouteIs('register')
          ->assertTitle($title)
          ->assertSee($register_text)
          ->assertSee($name_text)
          ->assertSee($email_text)
          ->assertSee($password_text)
          ->assertSee($password2_text)
          ->type('name', $test_user->name)
          ->type('email', $this->existing_user->email)
          ->type('password', $test_user->password)
          ->type('password_confirmation', $test_user->password)
          ->click($btn_class)
          ->assertPathIs('/register')
          ->assertSee($existing_email_text)
          ->type('name', $test_user->name)
          ->type('email', $test_user->email)
          ->type('password', $test_user->password)
          ->type('password_confirmation', $test_user->password)
          ->click($btn_class)
          ->assertPathIs('/');

          $this->assertTrue(1 === 1);

          $this->assertDatabaseHas('users', [
            'name' => $test_user->name
          ]);
      });
    }
}
