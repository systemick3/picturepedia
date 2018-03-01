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

    /**
     * Check submission of user edit form.
     *
     * @return void
     */
    public function testUserEditForm()
    {
      $this->browse(function (Browser $browser) {
        $title = config('app.name', 'Picturepedia');
        $avatar_class = '.avatar';
        $new_name = 'user__1';
        $new_email = 'user__1@example.com';
        $new_first_name = 'USER';
        $new_last_name = 'ONE';
        $new_password = 'user__1';
        $btn_class = '.btn-primary';
        $confirmation_text = 'Your profile was succesfully updated';
        $credentials_text = 'These credentials do not match our record';

        $browser->loginAs($this->existing_user)
          ->visitRoute('user.edit', ['id' => $this->existing_user->id])
          ->assertSee(config('app.name', 'Picturepedia'))
          ->assertRouteIs('user.edit', ['id' => $this->existing_user->id])
          ->assertTitle($title)
          ->assertSourceHas('<input id="name" type="text" name="name" value="' . $this->existing_user->name . '" required="required" autofocus="autofocus" class="form-control" />')
          ->assertInputValue('name', $this->existing_user->name)
          ->assertSourceHas('<input id="email" type="email" name="email" value="' . $this->existing_user->email . '" required="required" class="form-control" />')
          ->assertInputValue('email', $this->existing_user->email)
          ->assertSourceHas('<input id="first-name" type="text" name="first_name" value="' . $this->existing_user->first_name . '" autofocus="autofocus" class="form-control" />')
          ->assertInputValue('first_name', $this->existing_user->first_name)
          ->assertSourceHas('<input id="last-name" type="text" name="last_name" value="' . $this->existing_user->last_name . '" autofocus="autofocus" class="form-control" />')
          ->assertInputValue('last_name', $this->existing_user->last_name)
          ->assertSourceHas('<input id="password" type="password" name="password" class="form-control" />')
          ->assertSourceHas('<input id="password-confirm" type="password" name="password_confirmation" class="form-control" />')
          ->assertVisible($avatar_class)
          ->assertSeeLink('Change this avatar')
          ->type('name', $new_name)
          ->type('email', $new_email)
          ->type('first_name', $new_first_name)
          ->type('last_name', $new_last_name)
          ->click($btn_class)
          ->assertRouteIs('user.edit', ['id' => $this->existing_user->id])
          ->assertSee($confirmation_text);

        $this->assertDatabaseHas('users', [
          'name' => $new_name
        ]);

        $edited_user = User::find($this->existing_user->id);
        $this->assertTrue($edited_user->name === $new_name);
        $this->assertTrue($edited_user->email === $new_email);
        $this->assertTrue($edited_user->first_name === $new_first_name);
        $this->assertTrue($edited_user->last_name === $new_last_name);

        $browser->type('password', $new_password)
          ->type('password_confirmation', $new_password)
          ->click($btn_class)
          ->assertRouteIs('user.edit', ['id' => $this->existing_user->id])
          ->assertSee($confirmation_text)
          ->clickLink('Logout')
          ->assertPathIs('/')
          ->clickLink('Login')
          ->type('email', $new_email)
          ->type('password', $this->existing_user->password)
          ->click($btn_class)
          ->assertPathIs('/login')
          ->assertSee($credentials_text);
      });
    }

    /**
     * Check elements on user profile page.
     *
     * @return void
     */
    public function testUserProfile()
    {

    }
}
